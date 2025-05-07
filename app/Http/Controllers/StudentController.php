<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StudentPlacement;


class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('registrar.students.index', compact('students'));
    }

    public function index2()
    {
        // Fetch students and check if they are assigned
        $students = Student::all()->map(function ($student) {
            // Check if the student is assigned by looking for their student_id in the student_placement table
            $student->assigned = StudentPlacement::where('student_id', $student->student_id)->exists();
            return $student;
        });

        return view('registrar.students.index', compact('students'));
    }

    // Assign student
    public function assign($student_id)
    {
        $student = Student::findOrFail($student_id);
        
        // Create a record in the student_placement table
        StudentPlacement::create(['student_id' => $student->student_id, 'assigned_at' => now()]);
        
        return redirect()->route('students')->with('success', 'Student assigned successfully');
    }

    // Reassign student
    public function reassign($student_id)
    {
        $student = Student::findOrFail($student_id);
        
        // Reassign the student, you can add more logic if needed
        StudentPlacement::where('student_id', $student->student_id)->update(['assigned_at' => now()]);
        
        return redirect()->route('students')->with('success', 'Student reassigned successfully');
    }

    // Delete student
    public function delete($student_id)
    {
        $student = Student::findOrFail($student_id);
        
        // Delete student and their placement record
        StudentPlacement::where('student_id', $student->student_id)->delete();
        $student->delete();
        
        return redirect()->route('students')->with('success', 'Student deleted successfully');
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:students|max:50',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|unique:students|max:50',
            'gender' => 'required',
            'status' => 'required',
            'citizenship' => 'nullable|max:50',
            'disability_status' => 'nullable|max:10',
        ]);

        Student::create($request->all());

        return redirect()->route('registrar.students.index');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|max:50|unique:students,student_id,' . $id,
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|max:50|unique:students,email,' . $id,
            'gender' => 'required',
            'status' => 'required',
            'citizenship' => 'nullable|max:50',
            'disability_status' => 'nullable|max:10',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('students.index');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index');
    }
    
}