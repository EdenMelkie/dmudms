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


    // Handle assigning a specific student to a placement
    public function assignStudentToPlacement($student_id)
    {
        $placement = Block::firstWhere('status', 'available');
        $student = Student::findOrFail($student_id);
        $place = Room::firstWhere('status', 'Free');

        if ($placement) {
            $student->status = 'assigned';

            StudentPlacement::updateOrCreate(
                ['student_id' => $student->student_id],
                [
                    'block' => $placement->block_id,
                    'room' => $place->room_id,
                    'status' => 'assigned',
                    'year' => now()->year,
                ]
            );
            $student->save();
        }

        return redirect()->route('placements.index')
            ->with('success', 'Student assigned to placement successfully.');
    }


    public function unassign($student_id)
    {
        $placement = StudentPlacement::where('student_id', $student_id)->firstOrFail();

        // Find room using composite key
        $room = Room::where('room_id', $placement->room)
            ->where('block', $placement->block)
            ->first();

        if ($room) {
            $room->update(['status' => 'Free']);
            
        }
 
        $placement->delete();
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

            $newStatus = $currentOccupancy >= 6 ? 'Occupied' : 'Partially Occupied';
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
        // Get all registered students not yet assigned, ordered by batch
        $students = Student::where('status', 'Registered')
            ->whereDoesntHave('placement')
            ->orderBy('batch')
            ->get();

        // Get all available blocks with their rooms
        $blocks = Block::with(['rooms' => function ($query) {
            $query->whereIn('status', ['Free', 'Partially Occupied'])
                ->withCount('placements');
        }])->get();

        foreach ($students as $student) {
            foreach ($blocks as $block) {
                // Check block compatibility
                if (($block->disability_group === 'Yes' && $student->disability_status !== 'Yes') ||
                    ($block->disability_group === 'No' && $student->disability_status === 'Yes') ||
                    ($block->reserved_for && $block->reserved_for !== $student->gender)
                ) {
                    continue;
                }


                // Find suitable room in this block
                foreach ($block->rooms as $room) {
                    if ($room->placements_count < 6) {
                        // Assign student to this room
                        StudentPlacement::create([
                            'student_id' => $student->student_id,
                            'block' => $block->block_id,
                            'room' => $room->room_id,
                            'status' => 'assigned',
                            'year' => now()->year,
                        ]);

                        // Update room status
                        $newCount = $room->placements_count + 1;
                        DB::table('room')
                            ->where('block', $room->block)
                            ->where('room_id', $room->room_id)
                            ->update([
                                'status' => $newCount >= 6 ? 'Occupied' : 'Partially',
                            ]);

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
