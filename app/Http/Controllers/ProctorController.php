<?php

// app/Http/Controllers/ProctorController.php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\ProctorPlacement;
use App\Models\StudentPlacement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Request as StudentRequest;


class ProctorController extends Controller
{
    public function showReassignForm($placement_id)
    {
        $placement = ProctorPlacement::with('block', 'proctor')->findOrFail($placement_id);
        $availableBlocks = Block::all(); // Or filter based on logic

        return view('coordinator.reassign', compact('placement', 'availableBlocks'));
    }

    public function updateReassignment(Request $request, $placement_id)
    {
        $request->validate([
            'block' => 'required|string'
        ]);

        $placement = ProctorPlacement::findOrFail($placement_id);
        $placement->block = $request->block;
        $placement->save();

        return redirect()->route('coordinator.placement')->with('success', 'Proctor reassigned successfully.');
    }

    public function viewProctorsInBlock()
    {
        $proctorId = session('username');

        // Step 1: Get current proctor's block
        $placement = DB::table('proctor_placement')
            ->where('proctor_id', $proctorId)
            ->first();

        if (!$placement) {
            return redirect()->back()->with('error', 'Proctor not assigned to any block.');
        }

        $block = $placement->block;

        // Step 2: Get all proctors in the same block
        $proctors = DB::table('proctor_placement')
            ->join('employees', 'proctor_placement.proctor_id', '=', 'employees.employee_id')
            ->where('proctor_placement.block', $block)
            ->select(
                'proctor_placement.proctor_id',
                'proctor_placement.year',
                'proctor_placement.first_entry',
                'employees.first_name',
                'employees.second_name',
                'employees.last_name',
                'employees.gender',
                'employees.phone',
                'employees.email'
            )
            ->get();

        return view('proctor.viewroom', compact('proctors', 'block'));
    }


    public function index()
    {
        $requests = Request::all();
        return view('requests.index', compact('requests'));
    }

    public function fetchProctorRequests(Request $request)
{
    // Step 1: Get proctor username from session
    $username = session('username');

    // Step 2: Find the proctor's assigned block
    $proctorPlacement = ProctorPlacement::where('proctor_id', $username)->first();

    if (!$proctorPlacement) {
        return response()->json(['message' => 'Proctor block not found'], 404);
    }

    $proctorsBlock = $proctorPlacement->block;

    // Step 3: Get student IDs in that block
    $studentIds = StudentPlacement::where('block', $proctorsBlock)
                    ->pluck('student_id');

    // Step 4: Fetch requests from those students
    $requests = StudentRequest::whereIn('student_id', $studentIds)->get();

    // Step 5: Display or return the requests
    return view('coordinator.requests', compact('requests'));
}
}
