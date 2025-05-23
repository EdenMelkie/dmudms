<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Block;
use Illuminate\Support\Facades\Log;
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
        // Use session value for searchValue
        $searchValue = session('username');
        Log::info('Session username retrieved for placement lookup.', ['username' => $searchValue]);

        // Fetch student placements based on search criteria
        $placements = DB::table('student_placement')
            ->join('students', 'student_placement.student_id', '=', 'students.student_id')
            ->where('student_placement.student_id', 'LIKE', '%' . $searchValue . '%')
            ->select('student_placement.*', 'students.first_name', 'students.second_name', 'students.last_name')
            ->get();

        Log::info('Student placements fetched.', ['placements_count' => $placements->count()]);

        $roommates = collect(); // Default empty collection
        $proctors = collect();  // Default empty collection

        if ($placements->isNotEmpty()) {
            $room = $placements->first()->room;
            $block = $placements->first()->block;

            Log::info('Room and block identified from placement.', ['room' => $room, 'block' => $block]);

            // Fetch all students in the same room and block
            $roommates = DB::table('student_placement')
                ->where('room', $room)
                ->where('block', $block)
                ->where('student_placement.student_id', '!=', $searchValue)
                ->join('students', 'student_placement.student_id', '=', 'students.student_id')
                ->select('student_placement.*', 'students.first_name', 'students.second_name', 'students.last_name')
                ->get();

            Log::info('Roommates fetched.', ['roommates_count' => $roommates->count()]);

            // Fetch assigned proctors for the block
            $proctors = DB::table('proctor_placement')
                ->where('block', $block)
                ->join('employees', 'proctor_placement.proctor_id', '=', 'employees.employee_id')
                ->select('employees.first_name', 'employees.second_name', 'employees.last_name', 'employees.email', 'employees.phone', 'employees.gender')
                ->get();

            Log::info('Proctors fetched for block.', ['proctors_count' => $proctors->count()]);
        } else {
            Log::warning('No placements found for the given username.', ['username' => $searchValue]);
        }

        // Pass the fetched data to the view
        Log::info('Passing data to view.', [
            'placements_count' => $placements->count(),
            'roommates_count' => $roommates->count(),
            'proctors_count' => $proctors->count()
        ]);

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

        // Get blocks matching student's gender, disability status, and are free
        if ($student->disability_status === 'Yes') {
            $blocks = Block::where('disable_group', 'Yes')
                ->where('reserved_for', $student->gender)
                ->where('status', 'Free')
                ->get();
        } else {
            $blocks = Block::where('reserved_for', $student->gender)
                ->where('status', 'Free')
                ->get();
        }

        if ($blocks->isEmpty()) {
            return back()->with('error', 'No available blocks matching student\'s gender and disability status.');
        }

        // Collect eligible rooms with less than 6 students assigned
        $eligibleRooms = collect();

        foreach ($blocks as $block) {
            // Determine room ID limit if disabled student
            $roomLimit = null;
            if ($student->disability_status === 'Yes') {
                if ($block->capacity == 79) {
                    $roomLimit = 25;
                } elseif ($block->capacity == 25) {
                    $roomLimit = 10;
                } elseif ($block->capacity == 24) {
                    $roomLimit = 7;
                }
            }

            // Fetch rooms with status Free and (if disabled) below roomLimit
            $roomsQuery = Room::where('block', $block->block_id)
                ->where('status', 'Free');

            if ($roomLimit !== null) {
                $roomsQuery->where('room_id', '<', $roomLimit);
            }

            $rooms = $roomsQuery->orderBy('room_id')->get();

            foreach ($rooms as $room) {
                $assignedCount = StudentPlacement::where('block', $room->block)
                    ->where('room', $room->room_id)
                    ->where('status', 'assigned')
                    ->count();

                // Only add rooms with fewer than 6 assigned students
                if ($assignedCount < 6) {
                    $eligibleRooms->push($room);
                }
            }
        }

        if ($eligibleRooms->isEmpty()) {
            return back()->with('error', 'No available rooms with capacity found for the student.');
        }

        // Pick the first room that has available capacity
        $room = $eligibleRooms->first();

        $student->status = 'assigned';

        StudentPlacement::updateOrCreate(
            ['student_id' => $student->student_id],
            [
                'block' => $room->block,
                'room' => $room->room_id,
                'status' => 'assigned',
                'year' => now()->year,
            ]
        );

        // Update room status: 'Occupied' if 6 or more, otherwise 'Free'
        $placementCount = StudentPlacement::where('block', $room->block)
            ->where('room', $room->room_id)
            ->where('status', 'assigned')
            ->count();

        Room::where('room_id', $room->room_id)
            ->where('block', $room->block)
            ->update([
                'status' => $placementCount >= 6 ? 'Occupied' : 'Free',
            ]);

        $student->save();

        return redirect()->route('placements.index')
            ->with('success', 'Student assigned to placement successfully.');
    }


    public function unassignAll()
    {
        // Step 1: Get all current placements
        $placements = Room::join('student_placement', function ($join) {
            $join->on('student_placement.room', '=', 'room.room_id')
                ->whereColumn('student_placement.block', 'room.block');
        })
            ->whereIn('room.room_id', [1, 2])
            ->select(
                'room.*',
                'student_placement.student_id',
                'student_placement.block as placement_block' // to avoid column name conflict
            )
            ->limit(25)
            ->get();


        // Step 2: Prepare data for bulk updates
        $roomStatusUpdates = [];
        $studentStatusUpdates = [];

        // Loop through placements and prepare updates
        foreach ($placements as $placement) {
            $room_id = $placement->room_id;
            $block = $placement->block;

            if (!$room_id || !$block) {
                continue; // Skip if incomplete data
            }

            // Step 3: Count other students in the same room (excluding current)
            $otherPlacementsCount = StudentPlacement::where('room', $room_id)
                ->where('block', $block)
                ->where('student_id', '!=', $placement->student_id)
                ->count();

            // Step 4: Prepare room status update
            $roomStatusUpdates[$room_id][$block] = $otherPlacementsCount > 0 ? 'Free' : 'Free';

            // Step 5: Prepare student status update
            $studentStatusUpdates[$placement->student_id] = 'Registered';
        }

        // Step 6: Update room statuses in bulk
        foreach ($roomStatusUpdates as $room_id => $blocks) {
            foreach ($blocks as $block => $status) {
                Room::where('room_id', $room_id)
                    ->where('block', $block)
                    ->update(['status' => $status]);
            }
        }

        // Step 7: Update student statuses in bulk
        foreach ($studentStatusUpdates as $student_id => $status) {
            Student::where('student_id', $student_id)
                ->update(['status' => $status]);
        }

        // Step 8: Delete all placements at once
        StudentPlacement::query()->delete();

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
                    ->update(['status' => 'Free']);
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


    public function getAvailableRooms($student_id)
    {
        $student = Student::findOrFail($student_id);

        // For disabled students
        if ($student->disability_status === 'Yes') {
            $blocks = Block::where('disable_group', 'Yes')
                ->where('reserved_for', $student->gender)
                ->get();

            $eligibleRooms = collect();

            foreach ($blocks as $block) {
                $roomLimit = 0;

                // Set room limit based on block capacity
                if ($block->capacity == 79) {
                    $roomLimit = 25;
                } elseif ($block->capacity == 25) {
                    $roomLimit = 10;
                } elseif ($block->capacity == 24) {
                    $roomLimit = 7;
                }

                // Fetch eligible rooms
                $rooms = Room::where('block', $block->block_id)
                    ->where('room_id', '<', $roomLimit)
                    ->where('status', 'Free')  // Only free rooms
                    ->get();

                $eligibleRooms = $eligibleRooms->merge($rooms);
            }

            return response()->json($eligibleRooms->values());
        }

        // For non-disabled students
        $blocks = Block::where('reserved_for', $student->gender)->get();
        $eligibleRooms = Room::whereIn('block', $blocks->pluck('block_id'))
            ->where('status', 'Free')
            ->get();

        return response()->json($eligibleRooms->values());
    }


    // Handle auto-assigning students to placements (you can customize this further)
    public function autoAssignStudents()
    {
        $blocks = Block::with(['rooms' => function ($query) {
            $query->orderBy('room_id');
        }])->get();

        while (true) {
            // Try to fetch one unassigned disabled student
            $student = Student::where('status', 'Registered')
                ->whereDoesntHave('placement')
                ->where('disability_status', 'Yes')
                ->orderBy('batch')
                ->first();

            // If no disabled student found, try a normal student
            if (!$student) {
                $student = Student::where('status', 'Registered')
                    ->whereDoesntHave('placement')
                    ->where('disability_status', 'No')
                    ->orderBy('batch')
                    ->first();
            }

            // If no student found at all, break
            if (!$student) {
                Log::info('No more unassigned students found. Auto-assignment process ended.');
                break;
            }

            Log::info("Attempting to assign student ID: {$student->student_id}, Disability: {$student->disability_status}, Gender: {$student->gender}");

            $assigned = false;

            foreach ($blocks as $block) {
                // Skip incompatible blocks
                if (
                    ($block->disability_group === 'Yes' && $student->disability_status !== 'Yes') ||
                    ($block->disability_group === 'No' && $student->disability_status === 'Yes') ||
                    ($block->reserved_for && $block->reserved_for !== $student->gender)
                ) {
                    Log::info("Skipped Block ID: {$block->block_id} : { $block->disable_group }:{$student->disability_status} for student ID: {$student->student_id} due to incompatibility.");
                    continue;
                }

                // Determine max room based on block capacity
                $maxRoom = 6;
                if ($block->capacity == 79) $maxRoom = 26;
                elseif ($block->capacity == 24) $maxRoom = 7;
                elseif ($block->capacity == 29) $maxRoom = 10;

                foreach ($block->rooms as $room) {
                    if ($student->disability_status === 'Yes' && $room->room_id > $maxRoom) {
                        Log::info("Skipped Room {$room->room_id} in Block {$block->block_id} - not ground floor for disabled student ID: {$student->student_id}");
                        continue;
                    }

                    if ($student->disability_status !== 'Yes' && $room->room_id < $maxRoom) {  //No, 
                        Log::info("Skipped Room {$room->room_id} in Block {$block->block_id} - This is reserved for disabled students, ID: {$student->student_id}");
                        continue;
                    }

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

                        Room::where('block', $block->block_id)
                            ->where('room_id', $room->room_id)
                            ->update([
                                'status' => $currentCount + 1 >= 6 ? 'Occupied' : 'Free',
                            ]);

                        $student->status = 'assigned';
                        $student->save();

                        Log::info("Successfully assigned student ID: {$student->student_id} to Block: {$block->block_id}, Room: {$room->room_id}");

                        $assigned = true;
                        break 2;
                    } else {
                        Log::info("Room {$room->room_id} in Block {$block->block_id} is full ({$currentCount}/6).");
                    }
                }
            }

            if (!$assigned) {
                Log::warning("No suitable room found for student ID: {$student->student_id}. Stopping auto-assignment.");
                break;
            }
        }

        Log::info('Auto-assignment process completed.');
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

        $student = Student::findOrFail($student_id);
        if ($student->status !== 'Registered') {
            return redirect()->back()->with('error', 'Only registered students can be assigned');
        }

        $block = Block::where('name', $request->block)->firstOrFail();
        $room = Room::where('block', $block->block_id)
            ->where('room_id', $request->room)
            ->firstOrFail();

        // Capacity limit by block
        $maxRoom = 6;
        if ($block->capacity == 79) $maxRoom = 26;
        elseif ($block->capacity == 24) $maxRoom = 7;
        elseif ($block->capacity == 29) $maxRoom = 10;

        // For disabled students, ground floor rooms only
        if ($block->disable_group === 'Yes' && $student->disability_status === 'Yes') {
            if (!$room->room_id>$maxRoom) {
                return redirect()->back()->with('error', 'Only ground floor rooms can be assigned in this block');
            }
        }

        // For normal students, restrict by max room number
        if ($student->disability_status === 'NO' && $request->room < $maxRoom) {
            return redirect()->back()->with('error', 'This room is only allowed to Disabled students');
        }

        if ($room->status !== 'Free') {
            return redirect()->back()->with('error', 'Room is not available');
        }

        $currentOccupancy = StudentPlacement::where('block', $block->block_id)
            ->where('room', $request->room)
            ->count();

        if ($currentOccupancy >= 6) {
            return redirect()->back()->with('error', 'Room already has 6 students');
        }

        // Disability and gender checks
        if ($block->disable_group === 'No' && $student->disability_status !== 'Yes') {
            return redirect()->back()->with('error', 'This block is reserved for students with disabilities');
        }
        if ($block->disable_group === 'No' && $student->disability_status === 'Yes') {
            return redirect()->back()->with('error', 'This block is not suitable for students with disabilities');
        }
        if ($block->reserved_for && $block->reserved_for !== $student->gender) {
            return redirect()->back()->with('error', 'This block is reserved for ' . $block->reserved_for . ' students');
        }

        // Save placement
        StudentPlacement::updateOrCreate(
            ['student_id' => $student_id],
            [
                'block' => $block->block_id,
                'room' => $room->room_id,
                'status' => 'assigned',
                'year' => now()->year,
            ]
        );

        // Update room status
        $room->update([
            'status' => ($currentOccupancy + 1 >= 6) ? 'Occupied' : 'Free',
        ]);

        return redirect()->route('placements.index')
            ->with('success', 'Student assigned successfully');
    }


    public function replace(Request $request, $studentId)
    {
        Log::info("Replace operation started for student ID: {$studentId}", ['request' => $request->all()]);

        // Find the student's current placement
        $placement = StudentPlacement::where('student_id', $studentId)->first();

        if (!$placement) {
            Log::warning("Student placement not found", ['student_id' => $studentId]);
            return back()->with('error', 'Student placement not found.');
        }
        Log::info("Current placement found", ['placement' => $placement]);

        // Find the selected room based on the room ID and block
        $room = Room::where('room_id', $request->room_id)
            ->where('block', $request->block)
            ->first();

        if (!$room) {
            Log::warning("Selected room not found or invalid block", ['room_id' => $request->room_id, 'block' => $request->block]);
            return back()->with('error', 'Selected room not found or does not belong to the specified block.');
        }
        Log::info("Selected room found", ['room' => $room]);

        // Find the selected block
        $block = Block::find($request->block);

        if (!$block) {
            Log::warning("Selected block not found", ['block_id' => $request->block]);
            return back()->with('error', 'Selected block not found.');
        }
        Log::info("Selected block found", ['block' => $block]);

        // Check if the room is available (status == 'Free')
        if ($room->status !== 'Free') {
            Log::warning("Selected room not available", ['room_id' => $room->room_id, 'status' => $room->status]);
            return back()->with('error', 'Selected room is not available for assignment.');
        }
        Log::info("Selected room is available", ['room_id' => $room->room_id]);

        // Gender check
        if ($placement->student->gender != $block->reserved_for) {
            Log::warning("Gender mismatch for block", [
                'student_gender' => $placement->student->gender,
                'block_reserved_for' => $block->reserved_for
            ]);
            return back()->with('error', 'The selected block is not reserved for your gender.');
        }
        Log::info("Gender check passed");

        // --- Disability-specific logic ---
        if ($placement->student->disability_status === 'Yes') {
            if (
                ($block->capacity == 79 && $room->room_id < 25) ||
                ($block->capacity == 24 && $room->room_id < 7) ||
                ($block->capacity == 29 && $room->room_id < 10)
            ) {
                Log::warning("Room not suitable for disabled student", ['room_id' => $room->room_id]);
                return back()->with('error', 'This room is not suitable for students with a disability.');
            }
        } else {
            // --- New logic: allow normal students only in upper rooms of disabled blocks ---
            if (
                ($block->capacity == 79 && $room->room_id <= 25) ||
                ($block->capacity == 24 && $room->room_id <= 7) ||
                ($block->capacity == 29 && $room->room_id <= 10)
            ) {
                Log::warning("Room reserved for disabled students only", ['room_id' => $room->room_id]);
                return back()->with('error', 'This room is reserved for students with a disability.');
            }
        }
        Log::info("Disability check passed");

        // Free the old room
        $oldRoom = Room::where('room_id', $placement->room)
            ->where('block', $placement->block)
            ->first();

        if ($oldRoom) {
            Room::where('room_id', $oldRoom->room_id)
                ->where('block', $oldRoom->block)
                ->update(['status' => 'Free']);
            Log::info("Old room marked as Free", ['old_room_id' => $oldRoom->room_id]);
        }

        // Update placement
        $placement->room = $room->room_id;
        $placement->block = $block->block_id;
        $placement->status = 'assigned';
        $placement->save();
        Log::info("Placement updated", ['placement_id' => $placement->id]);

        // Count how many students are now in the room
        $assignedCount = StudentPlacement::where('room', $room->room_id)
            ->where('block', $room->block)
            ->where('status', 'assigned')
            ->count();

        // Update room status based on capacity (6)
        $status = ($assignedCount >= 6) ? 'Occupied' : 'Free';
        Room::where('room_id', $room->room_id)
            ->where('block', $room->block)
            ->update(['status' => $status]);
        Log::info("Room status updated", ['room_id' => $room->room_id, 'new_status' => $status]);

        return redirect()->route('placements.index')->with('success', 'Student replaced successfully.');
    }




    public function multiReplace(Request $request)
    {
        $studentIds = $request->input('student_ids', []);
        $roomIds = $request->input('room_ids', []);

        foreach ($studentIds as $i => $studentId) {
            $student = Student::find($studentId);
            $newRoomId = $roomIds[$i];

            if ($student && $newRoomId) {
                // Free the old room
                Room::where('room_id', $student->room_id)->update(['status' => 'Free']);

                // Assign new room
                Room::where('room_id', $newRoomId)->update(['status' => 'Occupied']);
                $student->room_id = $newRoomId;
                $student->save();
            }
        }

        return redirect()->back()->with('success', 'Students replaced successfully.');
    }
}
