<?php

// app/Http/Controllers/ProctorController.php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Material;
use App\Models\ProctorPlacement;
use App\Models\StudentPlacement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Request as StudentRequest;
use App\Models\Room;
use App\Models\Student;
use Illuminate\Support\Facades\Log;


class ProctorController extends Controller
{
        public function viewPlacedStudents()
{
    // Get the current proctor's ID from the session
    $proctor_id = session('username');

    // Fetch blocks assigned to the current proctor
    $blocks = ProctorPlacement::where('proctor_id', $proctor_id)
                              ->pluck('block'); // Get blocks assigned to the proctor

    // Fetch students with a studentPlacement in those blocks
   $placements = StudentPlacement::whereIn('block', $blocks)
    ->with('student') // Eager load the student data
    ->get();


    return view('proctor.view_placed_students', compact('placements'));
}


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

    public function create()
    {
        $proctorId = session('username'); // Adjust key if needed
        $blocks = ProctorPlacement::where('proctor_id', $proctorId)
            ->pluck('block', 'block') // [block => block] for select
            ->unique();

        return view('proctor.register_materials', compact('blocks'));
    }
public function store(Request $request)
{
    $validated = $request->validate([
        'block' => 'required|string|max:10',
        'room' => 'required|integer|unique:materials,room,NULL,NULL,block,' . $request->block, // Unique combination
        'unlocker' => 'required|in:Original,Copy',
        'locker' => 'required|integer|between:0,6',
        'chair' => 'required|integer|between:0,6',
        'pure_foam' => 'required|integer|between:0,6',
        'damaged_foam' => 'required|integer|between:0,6',
        'tiras' => 'required|integer|between:0,6',
        'tables' => 'required|integer|between:0,6',
        'chibud' => 'required|integer|between:0,6',
    ]);

    Material::create($validated);

    return redirect()->route('materials.view')->with('success', 'Material registered successfully.');
}


    public function getRooms($blockId)
    {
        $rooms = Room::where('block', $blockId)
            ->select('room_id', 'status', 'capacity')
            ->get();

        return response()->json($rooms);
    }

    public function view()
    {
        $materials = Material::orderByDesc('registration_id')->get();
        return view('proctor.materials', compact('materials'));
    }

    public function edit($id)
{
    $material = Material::findOrFail($id);
    $blocks = Block::pluck('block_id'); // adjust if needed
    $rooms = Room::pluck('room_id'); // adjust if needed

    return view('proctor.edit_materials', compact('material', 'blocks', 'rooms'));
}
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'block' => 'required|string|max:10',
        'room' => 'required|integer|unique:materials,room,NULL,NULL,block,' . $request->block . ',id,' . $id, // Unique combination
        'unlocker' => 'required|in:Original,Copy',
        'locker' => 'required|integer|min:0|max:6',
        'chair' => 'required|integer|min:0|max:6',
        'pure_foam' => 'required|integer|min:0|max:6',
        'damaged_foam' => 'required|integer|min:0|max:6',
        'tiras' => 'required|integer|min:0|max:6',
        'tables' => 'required|integer|min:0|max:6',
        'chibud' => 'required|integer|min:0|max:6',
    ]);

    $material = Material::findOrFail($id);
    $material->update($validated);

    return redirect()->route('materials.view')->with('success', 'Material updated successfully.');
}

public function destroy($id)
{
    $material = Material::findOrFail($id);
    $material->delete();

    return redirect()->route('materials.view')->with('success', 'Material deleted successfully.');
}

}
