<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Notification;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Inertia\Response;
use Illuminate\Support\Facades\validator;

class RegistrarController extends Controller
{
    public function index()
    {
        return view('registrar.index');
    }

    public function resetPassword($id)
    {
        $student = Student::findOrFail($id);
        $rawPassword = $student->last_name . '1234abcd#';
        $student->password = bcrypt($rawPassword);
        $student->save();

        return redirect()->route('admin.students')->with('success', "Password reset for {$student->first_name} {$student->last_name}.");
    }


    public function showStudents(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $students = Student::where('student_id', 'like', "%{$search}%")
                ->orWhere('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->get();
        } else {
            $students = Student::all();
        }

        return view('registrar.students.index', compact('students'));
    }


    public function editStudent($id)
    {
        $student = Student::findOrFail($id);
        return view('registrar.students.edit', compact('student'));
    }

    public function updateStudent(Request $request, $id)
    {
        $student = Student::findOrFail($id); // Find the student

        if ($student->status == 'unactivated') {
            return back()->with('error', 'Only students with status Activated can be ultered.');
        }
        // Update student info
        $student->update([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'disability_status' => $request->disability_status,
            'status' => $request->status,
        ]);

        // Remove placement if status is Disciplined or Transferred
        if (in_array($request->status, ['Disciplined', 'Transferred'])) {
            DB::table('student_placement')->where('student_id', $id)->delete();
        }

        return redirect()->route('registrar.students')->with('success', 'Student updated successfully.');
    }


    public function deleteStudent($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('registrar.students')->with('success', 'Student deleted successfully!');
    }

    // Show registration form
    public function showRegistrationForm()
    {
        return view('registrar.students.create');
    }

    // Store student from manual registration form
    public function storeStudent(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'gender' => 'required|string',
            'batch' => 'required|integer|min:1|max:7',
            'disability_status' => 'required|string',
        ]);
        //            'department' => 'required|string|max:40',


        // Check if the student_id already exists
        if (Student::where('student_id', $validatedData['student_id'])->exists()) {
            return redirect()->back()->withInput()->with('error', 'This student ID (' . $validatedData['student_id'] . ') is already registered.');
        }

        $lastStudent = Student::orderBy('student_id', 'desc')->first();
        $lastStudentId = $lastStudent ? substr($lastStudent->student_id, 3) : 0;
        $newStudentId = 'DMU' . str_pad($lastStudentId + 1, 7, '0', STR_PAD_LEFT);

        $password = Hash::make($validatedData['last_name'] . '1234abcd#');

        Student::create([
            'student_id' => $validatedData['student_id'],
            'first_name' => $validatedData['first_name'],
            'second_name' => $validatedData['second_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'gender' => $validatedData['gender'],
            'status' => 'unactivated',
            'batch' => $validatedData['batch'],
            'disability_status' => $validatedData['disability_status'] ?? 'No',
            'password' => $password,
        ]);
        //            'department' => $validatedData['department'],


        return redirect()->route('registrar.students')->with('success', 'Student created successfully!');
    }


    // Handle student registration via file upload

    public function uploadStudents(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:10240',
        ]);

        $file = $request->file('file');
        $csvData = array_map('str_getcsv', file($file->getRealPath()));

        if (count($csvData) > 0) {
            $header = $csvData[0];
            $expectedHeaders = [
                'student_id',
                'first_name',
                'second_name',
                'last_name',
                'email',
                'gender',
                'batch',
                'disability_status'
            ];

            if (array_map('strtolower', $header) !== $expectedHeaders) {
                return redirect()->back()->with('error', 'Invalid CSV format. Ensure correct column names and order.');
            }

            $skippedIds = [];

            for ($i = 1; $i < count($csvData); $i++) {
                $row = $csvData[$i];
                $studentId = $row[0];

                // Check for duplicate student_id
                if (Student::where('student_id', $studentId)->exists()) {
                    $skippedIds[] = $studentId;
                    continue;
                }

                $password = Hash::make($row[3] . '1234abcd#'); // last_name + static part

                Student::create([
                    'student_id'         => $studentId,
                    'first_name'         => $row[1],
                    'second_name'        => $row[2],
                    'last_name'          => $row[3],
                    'email'              => $row[4],
                    'gender'             => $row[5],
                    'batch'              => $row[6],
                    'disability_status'  => $row[7],
                    'status'             => 'unactivated',
                    'password'           => $password,
                ]);
            }

            // Prepare feedback message
            $message = 'Students uploaded successfully!';
            if (count($skippedIds) > 0) {
                $message .= ' However, the following IDs were already registered So, skipped: ' . implode(', ', $skippedIds);
            }

            return redirect()->route('registrar.students')->with('success', $message);
        }

        return redirect()->back()->with('error', 'Empty CSV file.');
    }



    public function showUploadForm()
    {
        return view('registrar.students.upload');
    }

    /**
     * Display notifications
     */
    public function notify()
    {
        $notifications = Notification::orderBy('date', 'desc')->get();

        return view('registrar.notification', compact('notifications'));
    }

    public function storeNotification(Request $request)
    {
        $validated = $request->validate([
            'registrar_id' => 'required|string',
            'message' => 'required|string',
        ]);

        $notification = Notification::create([
            'registrar_id' => $validated['registrar_id'],
            'message' => $validated['message'],
            'status' => 'Unread',
            'date' => now(),
        ]);

        return redirect()->route('registrar.notify')->with('success', 'Notification sent successfully!');
    }

    public function deleteNotification($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->route('registrar.notify')->with('success', 'Notification deleted successfully!');
    }
}
