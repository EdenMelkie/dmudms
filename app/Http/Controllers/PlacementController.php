<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Block;
use Illuminate\Support\Facades\DB;
use App\Models\Room;
use App\Models\StudentPlacement;
use Illuminate\Http\Request;

class PlacementController extends Controller
{

    public function search(Request $request)
    {
        $validated = $request->validate([
            'search_by' => 'required|in:student_id,block,room,status,year',
            'search_value' => 'required|string'
        ]);

        $placements = StudentPlacement::where($validated['search_by'], 'like', '%' . $validated['search_value'] . '%')
            ->orderBy('student_id')
            ->get();

        return view('search', compact('placements'));
    }

    public function searchForm()
    {
        return view('search'); // or your view name
    }


    public function viewRooms(Request $request)
    {
        $searchBy = $request->input('search_by');
        $searchValue = $request->input('search_value');

        // Fetch student placements based on search criteria
        $placements = DB::table('student_placement')
            ->join('students', 'student_placement.student_id', '=', 'students.student_id') // Join students table
            ->where('student_placement.student_id', 'LIKE', '%' . $searchValue . '%') // Specify the table for the column
            ->select('student_placement.*', 'students.first_name', 'students.second_name', 'students.last_name') // Include names
            ->get();


        $roommates = collect(); // Default empty collection
        $proctors = collect(); // Default empty collection

        // If search is by student ID and a result is found
        if ($searchBy === 'student_id' && $placements->isNotEmpty()) {
            $room = $placements->first()->room;
            $block = $placements->first()->block;

            // Fetch all students in the same room and block
            $roommates = DB::table('student_placement')
                ->where('room', $room)
                ->where('block', $block)
                ->where('student_placement.student_id', '!=', $searchValue)
                ->join('students', 'student_placement.student_id', '=', 'students.student_id')
                ->select('student_placement.*', 'students.first_name', 'students.second_name', 'students.last_name')
                ->get();



            // Fetch assigned proctors for the block
            $proctors = DB::table('proctor_placement')
                ->where('block', $block)
                ->join('employees', 'proctor_placement.proctor_id', '=', 'employees.employee_id')
                ->select('employees.first_name', 'employees.second_name', 'employees.last_name', 'employees.email', 'employees.phone', 'employees.gender')
                ->get();
        }

        // Pass the fetched data to the view
        return view('students.placement', compact('placements', 'roommates', 'proctors'));
    }

    public function viewPlacement()
    {
        return view('students.placement');
    }

    public function viewRoom(Request $request)
    {
        // Directly assign search_value to session('username') if search_by is student_id
        if ($request->search_by === 'student_id') {
            $request->merge(['search_value' => session('username')]);  // Override search_value
        }

        // Validate the input with the modified search_value if needed
        $validated = $request->validate([
            'search_by' => 'required|in:student_id,block,room,status,year',
            'search_value' => 'required|string'
        ]);

        // Perform the search query
        $placements = StudentPlacement::where($validated['search_by'], 'like', '%' . $validated['search_value'] . '%')
            ->orderBy('student_id')
            ->get();

        // Return the results to the view
        return view('students.placement', compact('placements'));
    }



    public function activate($placement_id)
    {
        $placement = StudentPlacement::findOrFail($placement_id);
        $placement->status = 'Getin';
        $placement->save();

        return redirect()->back()->with('activated', 'Student has been successfully activated.');
    }

    // Handle assigning a specific student to a placement
    public function assignStudentToPlacement($student_id)
    {
        $student = Student::findOrFail($student_id);
        $block = Block::where('status', 'available')->first();

        if (!$block) {
            return back()->with('error', 'No available blocks.');
        }

        $room = Room::where('block', $block->block_id)
            ->orderBy('room_id')
            ->get()
            ->first(function ($r) {
                $count = StudentPlacement::where('block', $r->block)
                    ->where('room', $r->room_id)
                    ->count();
                return $count < 6;
            });

        if (!$room) {
            return back()->with('error', 'All rooms are full in this block.');
        }

        $student->status = 'assigned';

        StudentPlacement::updateOrCreate(
            ['student_id' => $student->student_id],
            [
                'block' => $block->block_id,
                'room' => $room->room_id,
                'status' => 'assigned',
                'year' => now()->year,
            ]
        );

        // Update room status
        $placementCount = StudentPlacement::where('block', $room->block)
            ->where('room', $room->room_id)
            ->count();

        Room::where('room_id', $room->room_id)
            ->where('block', $room->block)
            ->update([
                'status' => $placementCount >= 6 ? 'Occupied' : 'Partially',
            ]);

        $student->save();

        return redirect()->route('placements.index')
            ->with('success', 'Student assigned to placement successfully.');
    }

    public function unassignAll()
    {
        // Step 1: Get all current placements
        $placements = StudentPlacement::all();

        // Loop through all placements until there are no more records
        while ($placements->count() > 0) {
            foreach ($placements as $placement) {
                $room_id = $placement->room;
                $block = $placement->block;

                if (!$room_id || !$block) {
                    continue; // Skip if incomplete data
                }

                // Step 2: Count other students in the same room (excluding current)
                $otherPlacements = StudentPlacement::where('room', $room_id)
                    ->where('block', $block)
                    ->where('student_id', '!=', $placement->student_id)
                    ->count();

                // Step 3: Update room status
                $room = Room::where('room_id', $room_id)->where('block', $block)->first();
                if ($room) {
                    Room::where('room_id', $room_id)
                        ->where('block', $block)
                        ->update([
                            'status' => $otherPlacements > 0 ? 'Partially' : 'Free'
                        ]);
                }

                // Step 4: Update student's status to 'Registered'
                Student::where('student_id', $placement->student_id)
                    ->update(['status' => 'Registered']);
            }

            // After processing all students, refresh the placements list
            $placements = StudentPlacement::all();
        }

        // Step 5: Delete all placements at once
        StudentPlacement::delete();

        return redirect()->back()->with('success', 'All students unassigned successfully.');
    }


    public function unassign($student_id)
    {
        // Step 1: Fetch the placement record for the given student_id
        $placement = StudentPlacement::where('student_id', $student_id)->firstOrFail();

        // Step 2: Get room_id and block from the StudentPlacement
        $room_id = $placement->room;
        $block = $placement->block;

        // Step 3: Check if room_id and block are valid before updating
        if (is_null($room_id) || is_null($block)) {
            return redirect()->back()->with('error', 'Room or Block information is missing.');
        }

        // Step 4: Check if other students are still placed in this room and block (excluding this student)
        $otherPlacements = StudentPlacement::where('room', $room_id)
            ->where('block', $block)
            ->where('student_id', '!=', $student_id)
            ->count();

        // Step 5: Find the room
        $room = Room::where('room_id', $room_id)->where('block', $block)->first();

        if ($room) {
            // Step 6: Update room status based on whether others are placed
            if ($otherPlacements > 0) {
                Room::where('room_id', $room_id)
                    ->where('block', $block)
                    ->update(['status' => 'Partially']);
            } else {
                // Update the room status to 'Free' only if no other students are placed
                Room::where('room_id', $room_id)
                    ->where('block', $block)
                    ->update(['status' => 'Free']);
            }
        } else {
            return redirect()->back()->with('error', 'Room not found.');
        }

        // Step 7: Delete the placement record
        $placement->delete();

        // Step 8: Update the student's status to 'Registered'
        Student::where('student_id', $student_id)->update(['status' => 'Registered']);

        return redirect()->back()->with('success', 'Student unassigned successfully.');
    }


    // In your PlacementController
    public function index()
    {
        $placements = StudentPlacement::with('student')->get();
        $students = Student::whereDoesntHave('placement')->get();
        $freeRooms = Room::where('status', 'Free')->with('blockRelation')->get();
        $blocks = Block::all(['block_id']); // Only get block_id since that's all we need

        return view('placement.index', compact('placements', 'students', 'freeRooms', 'blocks'));
    }

    public function replace(Request $request, $student_id)
    {
        $request->validate([
            'room_id' => 'required|integer|exists:room,room_id',
            'block' => 'required|string|exists:block,block_id',
        ]);

        DB::beginTransaction();
        try {
            $placement = StudentPlacement::where('student_id', $student_id)->firstOrFail();

            // Free up old room
            $oldRoom = Room::where('room_id', $placement->room)
                ->where('block', $placement->block)
                ->first();

            if ($oldRoom) {
                $oldRoom->update(['status' => 'Free']);
            }

            // Assign to new room
            $newRoom = Room::where('room_id', $request->room_id)
                ->where('block', $request->block)
                ->firstOrFail();

            $placement->update([
                'block' => $newRoom->block,
                'room' => $newRoom->room_id,
            ]);

            // Update room status
            $currentOccupancy = StudentPlacement::where('block', $newRoom->block)
                ->where('room', $newRoom->room_id)
                ->count();

            $newStatus = $currentOccupancy >= 6 ? 'Occupied' : 'Partially';
            $newRoom->update(['status' => $newStatus]);

            DB::commit();
            return redirect()->back()->with('success', 'Student replaced successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to replace student: ' . $e->getMessage());
        }
    }
    // Handle auto-assigning students to placements (you can customize this further)
    public function autoAssignStudents()
    {
        $students = Student::where('status', 'Registered')
            ->whereDoesntHave('placement')
            ->orderBy('batch')
            ->get();

        $blocks = Block::with(['rooms' => function ($query) {
            $query->orderBy('room_id');
        }])->get();

        foreach ($students as $student) {
            foreach ($blocks as $block) {
                if (
                    ($block->disability_group === 'Yes' && $student->disability_status !== 'Yes') ||
                    ($block->disability_group === 'No' && $student->disability_status === 'Yes') ||
                    ($block->reserved_for && $block->reserved_for !== $student->gender)
                ) {
                    continue;
                }

                foreach ($block->rooms as $room) {
                    $currentCount = StudentPlacement::where('block', $block->block_id)
                        ->where('room', $room->room_id)
                        ->count();

                    if ($currentCount < 6) {
                        StudentPlacement::create([
                            'student_id' => $student->student_id,
                            'block' => $block->block_id,
                            'room' => $room->room_id,
                            'status' => 'assigned',
                            'year' => now()->year,
                        ]);

                        // Update room status
                        $newCount = $currentCount + 1;
                        Room::where('block', $block->block_id)
                            ->where('room_id', $room->room_id)
                            ->update([
                                'status' => $newCount >= 6 ? 'Occupied' : 'Partially',
                            ]);

                        // Mark student assigned
                        $student->status = 'assigned';
                        $student->save();

                        continue 3; // Move to next student
                    }
                }
            }
        }

        return redirect()->route('placements.index')
            ->with('success', 'Auto assignment completed');
    }



    public function showStudents()
    {
        $students = Student::whereDoesntHave('placement')->get();
        $blocks = Block::all(); // Assuming you have a Block model

        return view('directorate.students.index', [
            'students' => $students,
            'blocks' => $blocks
        ]);
    }
    public function assignStudent(Request $request, $student_id)
    {
        $request->validate([
            'block' => 'required|string|max:10',
            'room' => 'required|integer',
        ]);

        // Find the student
        $student = Student::findOrFail($student_id);

        // Check if student is registered
        if ($student->status !== 'Registered') {
            return redirect()->back()
                ->with('error', 'Only students with "Registered" status can be assigned');
        }

        // Find the block and room
        $block = Block::where('name', $request->block)->firstOrFail();
        $room = Room::where('block', $block->block_id)
            ->where('room_id', $request->room)
            ->firstOrFail();

        // Check room status
        if ($room->status !== 'Free') {
            return redirect()->back()
                ->with('error', 'Room is not available for assignment');
        }

        // Check if room is already full (6 students)
        $currentOccupancy = StudentPlacement::where('block', $request->block)
            ->where('room', $request->room)
            ->count();

        if ($currentOccupancy >= 6) {
            return redirect()->back()
                ->with('error', 'Room already has maximum capacity (6 students)');
        }

        // Check disability compatibility
        if ($block->disability_group === 'Yes' && $student->disability_status !== 'Yes') {
            return redirect()->back()
                ->with('error', 'This block is reserved for students with disabilities');
        }

        if ($block->disability_group === 'No' && $student->disability_status === 'Yes') {
            return redirect()->back()
                ->with('error', 'This block is not suitable for students with disabilities');
        }

        // Check gender compatibility
        if ($block->reserved_for && $block->reserved_for !== $student->gender) {
            return redirect()->back()
                ->with('error', 'This block is reserved for ' . $block->reserved_for . ' students only');
        }

        // Create or update placement
        StudentPlacement::updateOrCreate(
            ['student_id' => $student_id],
            [
                'block' => $request->block,
                'room' => $request->room,
                'status' => 'assigned',
                'year' => now()->year,
            ]
        );

        // Update room status if it's now full
        if ($currentOccupancy + 1 >= 6) {
            $room->update(['status' => 'Occupied']);
        } else {
            $room->update(['status' => 'Partially']);
        }

        return redirect()->route('placements.index')
            ->with('success', 'Student assigned successfully');
    }
}
