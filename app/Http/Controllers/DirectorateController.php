<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Student;
use Illuminate\Http\Request;


class DirectorateController extends Controller
{
    // Method to show the reports page
    public function notify()
    {
        return view('directorate.notification'); // The view we will create next
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
                Room::where('room_id', $student->room)->update(['status' => 'Free']);

                // Assign new room
                Room::where('room_id', $newRoomId)->update(['status' => 'Occupied']);
                $student->room_id = $newRoomId;
                $student->save();
            }
        }

        return redirect()->back()->with('success', 'Students replaced successfully.');
    }
    public function fetchAvailableRooms(Request $request)
    {
        $studentIds = explode(',', $request->student_ids);
        $students = Student::whereIn('student_id', $studentIds)->get();

        $response = [];

        foreach ($students as $student) {
            $rooms = Room::where('status', 'Free')
                ->where('gender', $student->gender)
                ->where('disability', $student->disability)
                ->get();

            $response[] = [
                'id' => $student->id,
                'name' => $student->name,
                'rooms' => $rooms->map(fn($r) => [
                    'id' => $r->id,
                    'name' => $r->room_number,
                    'block' => $r->block->block_name,
                ]),
            ];
        }

        return response()->json($response);
    }
}
