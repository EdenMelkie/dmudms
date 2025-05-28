<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\Models\Block;
use App\Models\Employee;
use App\Models\ProctorPlacement;
use App\Models\StudentPlacement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CoordinatorController extends Controller
{
    public function assignStore(Request $request)
    {

        $request->validate([
            'proctor_id' => [
                'required',
                Rule::unique('proctor_placement', 'proctor_id')
                    ->where(fn($query) => $query->where('block', $request->block_id)),
            ],
            'block_id' => 'required|exists:block,block_id',
        ], [
            'proctor_id.unique' => 'This proctor is already assigned to the selected block.',
        ]);

        // Fetch the block details (block_id and proctor_id)
        $block = Block::where('block_id', $request->block_id)->first();
        Log::info('Fetched block for proctor assignment', [
            'block_id' => $block->block_id,
            'reserved_for' => $block->reserved_for
        ]);

        // Validate the proctor_id is not null
        if (!$request->proctor_id) {
            Log::warning('Proctor ID is missing', ['block_id' => $request->block_id]);
            return redirect()->back()->with('error', 'Proctor ID is required.');
        }

        // Fetch the proctor's gender using a join with the Employee model
        $proctor = User::join('employees', 'users.username', '=', 'employees.employee_id')
            ->where('users.username', $request->proctor_id)
            ->select('users.username', 'employees.gender')
            ->first();

        Log::info('Fetched proctor details', [
            'proctor_id' => $proctor->username,
            'gender' => $proctor->gender ?? 'not found'
        ]);

        // Check if the proctor's gender matches the block's reserved_for
        if ($proctor && $proctor->gender !== $block->reserved_for) {
            Log::warning('Gender mismatch for proctor assignment', [
                'proctor_id' => $proctor->proctor_id,
                'proctor_gender' => $proctor->gender,
                'block_reserved_for' => $block->reserved_for
            ]);
            return redirect()->back()->with('error', 'The selected proctor\'s gender does not match the block\'s gender requirement.');
        }

        // Check if the selected proctor already has a placement
        $existingPlacement = ProctorPlacement::where('proctor_id', $request->input('proctor_id'))->first();
        $firstEntry = $existingPlacement ? $existingPlacement->first_entry : now()->toDateString();

        if ($existingPlacement) {
            Log::info('Existing placement found for proctor', [
                'proctor_id' => $request->proctor_id,
                'first_entry' => $firstEntry
            ]);
        } else {
            Log::info('No existing placement. Using current date as first_entry', [
                'proctor_id' => $request->proctor_id,
                'first_entry' => $firstEntry
            ]);
        }

        // Create the ProctorPlacement
        ProctorPlacement::create([
            'proctor_id' => $request->proctor_id,
            'block' => $request->block_id,
            'year' => now()->year,
            'first_entry' => $firstEntry,
        ]);

        Log::info('Proctor assigned successfully', [
            'proctor_id' => $request->proctor_id,
            'block_id' => $request->block_id,
            'year' => now()->year
        ]);

        return redirect()->route('coordinator.blocks')->with('success', 'Proctor assigned successfully.');
    }




    public function assignForm($block_id)
    {
        // Find the block by its ID
        $block = Block::where('block_id', $block_id)->firstOrFail();

        // Fetch the gender requirement from the block (assumed 'reserved_for' is the gender)
        $reservedForGender = $block->reserved_for;

        // Fetch available proctors based on the block's reserved_for value (gender)
        $availableProctors = User::where('role', 'Proctor') // Ensure the user is a Proctor
            ->join('employees', 'users.username', '=', 'employees.employee_id') // Join with employees
            ->where('employees.gender', $reservedForGender) // Filter based on gender
            ->select('users.*', 'employees.first_name', 'employees.second_name', 'employees.last_name')
            ->get();

        // Return the view with the block and available proctors
        return view('coordinator.assign_proctor', compact('block', 'availableProctors'));
    }


    // Show all assignments
    public function manageProctorsAndAssignments()
    {
        // Fetch proctors with their assignments from the database
        $proctors = DB::table('proctor_placement')
            ->join('employees', 'proctor_placement.proctor_id', '=', 'employees.employee_id')
            ->select(
                'employees.employee_id',
                'employees.first_name',
                'employees.second_name',
                'employees.last_name',
                'employees.email',
                DB::raw('GROUP_CONCAT(DISTINCT proctor_placement.block) as blocks'),
                DB::raw('COUNT(DISTINCT proctor_placement.block) as block_count'),
                DB::raw('MIN(proctor_placement.first_entry) as first_entry') // To get the earliest assignment date
            )
            ->groupBy('proctor_placement.proctor_id', 'employees.employee_id', 'employees.first_name', 'employees.second_name', 'employees.last_name', 'employees.email')
            ->get();

        // Fetch assignments (ProctorPlacements) from the database
        $assignments = ProctorPlacement::all();

        // Return both proctors and assignments to the view
        return view('coordinator.placement', compact('proctors', 'assignments'));
    }


    // View Blocks (This could display blocks in a dormitory)
    public function viewBlocks()
    {
        // Fetch blocks from the database (example)
        $blocks = Block::all();

        return view('coordinator.blocks', compact('blocks'));
    }

    public function assignProctors(Request $request)
    {
        // Fetch available rooms based on the selected gender of the proctor
        $roomsQuery = Block::where('status', 'Free');

        // Check if a gender filter is applied (this could be coming from the selected proctor)
        if ($request->has('employee_id')) {
            // Get the selected proctor details
            $selectedProctor = User::join('employees', 'users.username', '=', 'employees.employee_id')
                ->where('users.role', 'Proctor')
                ->where('employees.employee_id', $request->input('employee_id'))
                ->first();

            // If the proctor is male, filter blocks reserved for males, otherwise for females
            if ($selectedProctor && $selectedProctor->gender === 'Male') {
                $roomsQuery->where('reserved_for', 'Male');
            } elseif ($selectedProctor && $selectedProctor->gender === 'Female') {
                $roomsQuery->where('reserved_for', 'Female');
            }
        }

        // Fetch the available rooms (filtered based on gender if applicable)
        $blocks = $roomsQuery->get();

        // Fetch all employees as proctors
        $proctors = User::join('employees', 'users.username', '=', 'employees.employee_id')
            ->where('users.role', 'Proctor')
            ->get();


        // Return the view with filtered rooms and all proctors
        return view('coordinator.assign', compact('blocks', 'proctors'));
    }


    public function store(Request $request)
    {
        // Log incoming request
        Log::info('Received proctor assignment request', $request->all());

        // Validate the incoming request     
        $validated = $request->validate([
            'employee_id' => [
                'required',
                'exists:employees,employee_id',
                Rule::unique('proctor_placement', 'proctor_id')
                    ->where(fn($query) => $query->where('block', $request->block_id)),
            ],
            'block_id' => 'required|exists:block,block_id',
            'year' => 'required|integer',
        ], [
            'proctor_id.unique' => 'This proctor is already assigned to the selected block.',
        ]);

        // Retrieve block info
        $block = Block::where('block_id', $request->input('block_id'))->first();
        Log::debug('Fetched block info', ['block' => $block]);

        // Retrieve proctor with user relation
        $proctor = Employee::with('user')
            ->where('employee_id', $request->input('employee_id'))
            ->first();
        Log::debug('Fetched proctor info', ['proctor' => $proctor]);

        // Check validity of data
        if (!$block || !$proctor || !$proctor->user) {
            Log::warning('Invalid block or proctor data', ['block' => $block, 'proctor' => $proctor]);
            return redirect()->back()->with('error', 'Invalid block or proctor information.');
        }

        // Gender compatibility check
        $proctorGender = $proctor->gender;
        $blockGender = $block->reserved_for;
        Log::info('Checking gender compatibility', ['proctorGender' => $proctorGender, 'blockGender' => $blockGender]);

        if ($proctorGender !== $blockGender) {
            $message = "This block is reserved for {$blockGender} only, so please assign a {$blockGender} proctor.";
            Log::notice('Gender mismatch', ['proctor_id' => $request->input('employee_id'), 'block_id' => $request->input('block_id')]);
            return redirect()->back()->with('error', $message);
        }


        // Check for existing placement
        $existingPlacement = ProctorPlacement::where('proctor_id', $request->input('employee_id'))->first();
        Log::debug('Existing placement found', ['placement' => $existingPlacement]);

        // Determine first_entry value
        $firstEntry = $existingPlacement ? $existingPlacement->first_entry : now()->toDateString();
        Log::info('Determined first_entry date', ['first_entry' => $firstEntry]);

        // Create new placement
        $placement = ProctorPlacement::create([
            'proctor_id' => $request->input('employee_id'),
            'block' => $request->input('block_id'),
            'year' => $request->input('year'),
            'first_entry' => $firstEntry,
        ]);
        Log::info('Proctor assigned successfully', ['placement' => $placement]);

        return redirect()->route('coordinator.placement')->with('success', 'Proctor assigned successfully!');
    }



    public function edit($employee_id)
    {
        // Fetch proctor data for editing
        // Fetch proctor data along with employee data using a join
        $proctor = ProctorPlacement::join('employees', 'proctor_placement.proctor_id', '=', 'employees.employee_id')
            ->where('proctor_placement.proctor_id', $employee_id)
            ->first(['proctor_placement.*', 'employees.first_name', 'employees.second_name', 'employees.last_name', 'employees.gender', 'proctor_placement.year']);

        // Fetch available rooms based on gender (same logic from assignProctors)
        $roomsQuery = Block::where('status', 'Free');

        if ($proctor) {
            if ($proctor->gender === 'Male') {
                $roomsQuery->where('reserved_for', 'Male');
            } elseif ($proctor->gender === 'Female') {
                $roomsQuery->where('reserved_for', 'Female');
            }
        }

        // Get available rooms based on the proctor's gender
        $rooms = $roomsQuery->get();

        // Return the view with the proctor and rooms data
        return view('coordinator.edit', compact('proctor', 'rooms'));
    }



    public function destroy($employee_id)
    {
        // Delete the proctor's assignment
        ProctorPlacement::where('proctor_id', $employee_id)->delete();

        return redirect()->route('coordinator.placement')->with('success', 'Proctor assignment deleted successfully!');
    }

    public function update(Request $request, $id)
    {
        $proctor = ProctorPlacement::findOrFail($id);
        $proctor->update($request->all());
        return redirect()->route('coordinator.placement'); // Or wherever you want to redirect
    }

    public function viewPlacedStudents()
    {

        // Fetch students with a studentPlacement 
        $placements = StudentPlacement::with('student')->get();


        return view('coordinator.view_students', compact('placements'));
    }

    public function updateproc(Request $request, $id)
    {
        $placement = ProctorPlacement::findOrFail($id);
        $placement->block = $request->input('block');
        $placement->year = $request->input('year');
        $placement->save();

        return redirect()->back()->with('success', 'Updated successfully.');
    }

    public function edit1($proctor_id)
    {
        $proctorPlacements = ProctorPlacement::with('proctor')
            ->where('proctor_id', $proctor_id)
            ->get();

        $roomsByGender = [
            'Male' => Block::where('status', 'Free')->where('reserved_for', 'Male')->get(),
            'Female' => Block::where('status', 'Free')->where('reserved_for', 'Female')->get(),
        ];

        return view('coordinator.edit1', compact('proctorPlacements', 'roomsByGender'));
    }
}
