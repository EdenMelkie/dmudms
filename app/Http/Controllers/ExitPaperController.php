<?php

namespace App\Http\Controllers;

use App\Models\ExitPaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExitPaperController extends Controller
{
    public function create()
    {
        // Get the student ID from the session
        $stud_id = session('username');

        $exitPapers = DB::table('exit_paper')->where('stud_id', $stud_id)->get();

        // Return the form view with the student ID
        return view('exit_papers.create', compact('stud_id', 'exitPapers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|array',
            'type.*' => 'required|string',
            'color' => 'required|array',
            'color.*' => 'required|string',
            'number' => 'required|array',
            'number.*' => 'required|numeric',
        ]);

        $stud_id = session('username');
        $now = now();

        foreach ($request->type as $i => $type) {
            ExitPaper::create([
                'stud_id' => $stud_id,
                'request_date' => $now,
                'type' => $type,
                'color' => $request->color[$i],
                'number' => $request->number[$i],
            ]);
        }

        return redirect()->back()->with('success', 'Exit paper request(s) submitted successfully.');
    }

    public function updateByDate(Request $request)
    {
        $stud_id = session('username');

        $request->validate([
            'request_date' => 'required|date',
            'type' => 'required|array',
            'color' => 'required|array',
            'number' => 'required|array',
        ]);

        $request_date = $request->input('request_date');
        $types = $request->input('type');
        $colors = $request->input('color');
        $numbers = $request->input('number');

        // Fetch all exit papers for the student and request_date
        $exitPapers = ExitPaper::where('stud_id', $stud_id)
            ->whereDate('request_date', $request_date)
            ->get();

        $errors = [];

        foreach ($exitPapers as $paper) {
            if ($paper->status === 'printed' || $paper->status !== 'pending') {
                $errors[] = "Item ID {$paper->exit_id},  {$paper->request_date} cannot be updated because its status is '{$paper->status}'.";
                continue;
            }

            if (isset($types[$paper->exit_id], $colors[$paper->exit_id], $numbers[$paper->exit_id])) {
                $paper->type = $types[$paper->exit_id];
                $paper->color = $colors[$paper->exit_id];
                $paper->number = $numbers[$paper->exit_id];
                $paper->save();
            }
        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }

        return redirect()->back()->with('success', 'Exit papers updated successfully for ' . $request_date);
    }

    public function viewByProctor(Request $request)
    {
        $proctor_id = session('username');

        // 1. Get blocks assigned to the proctor
        $blocks = DB::table('proctor_placement')
            ->where('proctor_id', $proctor_id)
            ->pluck('block');

        // 2. Get all exit papers for students in those blocks
        $exitPapersQuery = DB::table('exit_paper')
            ->whereIn('stud_id', function ($query) use ($blocks) {
                $query->select('student_id')
                    ->from('student_placement')
                    ->whereIn('block', $blocks);
            });

        if ($request->filled('status')) {
            $exitPapersQuery->where('status', $request->input('status'));
        }

        if ($request->filled('request_date')) {
            $exitPapersQuery->whereDate('request_date', $request->input('request_date'));
        }

        $exitPapers = $exitPapersQuery->get();

        // 3. Extract only student IDs that have exit papers
        $studentIds = $exitPapers->pluck('stud_id')->unique();

        // 4. Join student_placement with students to get full data
        $students = DB::table('student_placement')
            ->join('students', 'student_placement.student_id', '=', 'students.student_id')
            ->whereIn('student_placement.block', $blocks)
            ->whereIn('student_placement.student_id', $studentIds)
            ->select('student_placement.*', 'students.*') // you can customize the columns
            ->get();

        // 5. Get proctor info
        $proctor = DB::table('employees')->where('employee_id', $proctor_id)->first();

        // 6. Return view with data
        return view('exit_papers.proctor_view', [
            'students' => $students,
            'exitPapers' => $exitPapers,
            'blocks' => $blocks,
            'statusFilter' => $request->input('status'),
            'dateFilter' => $request->input('request_date'),
            'proctor' => $proctor,
        ]);
    }

    public function markAsPrinted(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string',
            'status' => 'nullable|string',
            'request_date' => 'nullable|date'
        ]);

        $query = ExitPaper::where('stud_id', $request->student_id);

        // Apply optional filters
        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->request_date) {
            $query->whereDate('request_date', $request->request_date);
        }

        $updatedCount = $query->update(['status' => 'printed']);

        return response()->json([
            'message' => "$updatedCount record(s) updated to printed."
        ]);
    }
}
