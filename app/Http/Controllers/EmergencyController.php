<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emergency;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Student;
use Illuminate\Support\Facades\Session;

class EmergencyController extends Controller
{

    public function index()
    {
        $username = session('username'); // assuming this holds the student_id
        $student = Student::with('emergency')->where('student_id', $username)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }

        return view('emergency.index', compact('student'));
    }

    public function create()
    {
        return view('emergency.create');
    }

    public function store(Request $request)
    {
        // Get student ID from session username
        $username = session('username');
        $student = Student::where('student_id', $username)->first();

        if (!$student) {
            return back()->withErrors(['Student not found.']);
        }

        Emergency::create([
            'student_id' => $student->student_id,
            'father_name' => $request->father_name,
            'grand_father' => $request->grand_father,
            'grand_grand_father' => $request->grand_grand_father,
            'phone' => $request->phone,
            'region' => $request->region,
            'woreda' => $request->woreda,
            'kebele' => $request->kebele,
            'mother_name' => $request->mother_name,
        ]);

        return redirect()->back()->with('success', 'Emergency info saved successfully.');
    }

    public function showProfile()
    {
        $studentId = Session::get('username'); // assuming 'username' holds the student_id
        $student = Student::with('emergency')->where('student_id', $studentId)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }

        return view('students.profile', compact('student'));
    }
    public function profile()
    {
        $student_id = session('username'); // assuming session contains student_id
        $student = Student::where('student_id', $student_id)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }

        return view('students.profile', compact('student'));
    }

    public function edit()
    {
        $student_id = session('username');
        $student = Student::where('student_id', $student_id)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }

        return view('students.profile', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $student->update($request->all());
        return redirect()->route('student.profile')->with('success', 'Student updated successfully.');
    }

    public function editProfile($student_id)
    {
        $student = Student::find($student_id);
        if (!$student) {
            return redirect()->route('student.profile', ['student_id' => $student_id])->with('error', 'Student not found');
        }
        return view('students.profileEdit', compact('student'));
    }
}
