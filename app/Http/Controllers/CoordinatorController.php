<?php

namespace App\Http\Controllers;

use App\Models\ProctorPlacement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoordinatorController extends Controller
{
    // Show all assignments
    public function viewAssignments()
    {
        // Fetch assignments from database (example)
        $assignments = ProctorPlacement::all();

        return view('coordinator.placement', compact('assignments'));
    }

    // Manage Proctors (This could display a list of proctors)
    public function manageProctors()
    {
        // Fetch proctors from the database (example)
        // $proctors = DB::table('proctor_placement')
        // ->join('employees','proctor_placement.proctor_id','=','employees.employee_id')
        // ->select('employees.*','proctor_placement.*')
        // ->get();
        $proctors = DB::table('proctor_placement')
            ->join('employees', 'proctor_placement.proctor_id', '=', 'employees.employee_id')
            ->select(
                'employees.*',
                'proctor_placement.*',
                DB::raw('COUNT(DISTINCT proctor_placement.block) as block_count')
            )
            ->groupBy('proctor_placement.proctor_id', 'proctor_placement.placement_id', 'proctor_placement.year', 'proctor_placement.first_entry', 'proctor_placement.block', 'employees.employee_id', 'employees.address', 'employees.citizenship', 'employees.first_name', 'employees.second_name', 'employees.last_name', 'employees.gender', 'employees.email', 'employees.phone') // Add all needed employee fields
            ->get();

        // $proctor = ProctorPlacement::all();

        return view('coordinator.proctor', compact('proctors'));
    }

    // View Blocks (This could display blocks in a dormitory)
    public function viewBlocks()
    {
        // Fetch blocks from the database (example)
        $blocks = \App\Models\Block::all();

        return view('coordinator.blocks', compact('blocks'));
    }

    public function assignProctors(Request $request)
{
    // Fetch available rooms based on the selected gender of the proctor
    $roomsQuery = \App\Models\Block::where('status', 'Available');

    // Check if a gender filter is applied (this could be coming from the selected proctor)
    if ($request->has('employee_id')) {
        // Get the selected proctor details
        $selectedProctor = \App\Models\Employee::find($request->input('employee_id'));

        // If the proctor is male, filter blocks reserved for males, otherwise for females
        if ($selectedProctor && $selectedProctor->gender === 'Male') {
            $roomsQuery->where('reserved_for', 'Male');
        } elseif ($selectedProctor && $selectedProctor->gender === 'Female') {
            $roomsQuery->where('reserved_for', 'Female');
        }
    }

    // Fetch the available rooms (filtered based on gender if applicable)
    $rooms = $roomsQuery->get();

    // Fetch all employees as proctors
    $proctors = \App\Models\Employee::all();

    // Return the view with filtered rooms and all proctors
    return view('coordinator.assign', compact('rooms', 'proctors'));
}

    public function storeProctorPlacement(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'proctor_id' => 'required|exists:employees,employee_id',  // Correct primary key for employees table
            'room_id' => 'required|exists:block,block_id',  // Correct primary key for blocks table
            'year' => 'required|integer',  // You can also validate other fields like 'year'
        ]);
    
        // Check if the selected employee already has a placement in proctor_placement
        $existingPlacement = \App\Models\ProctorPlacement::where('proctor_id', $request->input('proctor_id'))
                                                         ->first();
    
        // Determine the first_entry value:
        // - If the employee has an existing placement, use that first_entry
        // - If no placement exists, use the current date as first_entry
        $firstEntry = $existingPlacement ? $existingPlacement->first_entry : now()->toDateString(); // Use current date if no existing placement
    
        // Create or update the ProctorPlacement record
        \App\Models\ProctorPlacement::create([
            'proctor_id' => $request->input('proctor_id'),
            'block' => $request->input('room_id'),
            'year' => $request->input('year'),
            'first_entry' => $firstEntry,
        ]);
    
        // Redirect or return success response
        return redirect()->route('coordinator.assign')->with('success', 'Proctor assigned successfully!');
    }
    

}