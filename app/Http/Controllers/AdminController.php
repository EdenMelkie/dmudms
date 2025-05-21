<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Student;
use App\Models\StudentPlacement;
use Illuminate\Http\Request;


class AdminController extends Controller
{

    public function showStudents()
    {
        $students = Student::all(); // fetch all students regardless of status
        return view('admin.students', compact('students'));
    }

    public function activateStudent($id)
    {
        Student::where('student_id', $id)->update(['status' => 'Registered']);
        return redirect()->back()->with('success', 'Student activated.');
    }

    public function deactivateStudent($id)
    {
        $student = Student::where('student_id', $id)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }

        // If already unactivated, skip logic
        if ($student->status === 'unactivated') {
            return redirect()->back()->with('info', 'Student is already unactivated.');
        }

        // If assigned, find and update placement and room
        $placement = StudentPlacement::where('student_id', $id)->first();

        if ($placement) {
            // Get the old room
            $oldRoom = Room::where('room_id', $placement->room)
                ->where('block', $placement->block)
                ->first();

            if ($oldRoom) {
                // Mark old room as Free
                // $oldRoom->status = 'Free';
                Room::where('room_id', $oldRoom)
                    ->where('block', $placement->block)
                    ->update(['status' => 'Free']);
            }

            // Optionally delete or update placement status
            StudentPlacement::where('student_id', $id)->delete();
        }

        // Set student status to unactivated
        $student->status = 'unactivated';
        $student->save();

        return redirect()->back()->with('success', 'Student deactivated and room freed if assigned.');
    }


    public function activateAllStudents()
    {
        Student::where('status', 'unactivated')->update(['status' => 'Registered']);
        return redirect()->route('admin.students')->with('success', 'All unactivated students have been activated.');
    }

    /**
     * Show the Create Account page.
     */
    public function create()
    {
        return view('admin.create_account');
    }

    /**
     * Show the Update Account page.
     */
    public function update()
    {
        return view('admin.update_account');
    }

    /**
     * Show the Reset Account page.
     */
    public function reset()
    {

        return view('admin.reset_account');
    }
}
