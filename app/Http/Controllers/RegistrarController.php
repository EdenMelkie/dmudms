<?php
<<<<<<< HEAD

=======
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Student;
<<<<<<< HEAD
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
use Inertia\Response;
use Illuminate\Support\Facades\validator;

class RegistrarController extends Controller
{
    public function index()
    {
        return view('registrar.index');
    }

    public function showStudents()
    {
=======

class RegistrarController extends Controller
{
    public function index() {
        return view('registrar.index');
    }

    public function showStudents() {
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
        $students = Student::all(); // Fetch all students
        return view('registrar.students.index', compact('students'));
    }

<<<<<<< HEAD
    public function editStudent($id)
    {
=======
    public function editStudent($id) {
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
        $student = Student::findOrFail($id);
        return view('registrar.students.edit', compact('student'));
    }

<<<<<<< HEAD
    public function updateStudent(Request $request, $id)
    {
        $student = Student::findOrFail($id); // Find the student
        $student->update([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'disability_status' => $request->disability_status,
            'status' => $request->status,
        ]);

        return redirect()->route('registrar.students')->with('success', 'Student updated successfully.');
    }

    public function deleteStudent($id)
    {
=======
    public function updateStudent(Request $request, $id) {
        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('registrar.students')->with('success', 'Student updated successfully!');
    }

    public function deleteStudent($id) {
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('registrar.students')->with('success', 'Student deleted successfully!');
    }

    // Show registration form
    public function showRegistrationForm()
    {
<<<<<<< HEAD
        return view('registrar.students.create');
=======
        return view('registrar.students.register');
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
    }

    // Store student from manual registration form
    public function storeStudent(Request $request)
    {
<<<<<<< HEAD
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'gender' => 'required|string',
            'batch' => 'required|integer|min:1',
            'disability_status' => 'nullable|string',
        ]);

        $lastStudent = Student::orderBy('student_id', 'desc')->first();
        $lastStudentId = $lastStudent ? substr($lastStudent->student_id, offset: 3) : 0;
        $newStudentId = 'DMU' . str_pad($lastStudentId + 1, 7, '0', STR_PAD_LEFT);

        $password = Hash::make($validatedData['last_name'] . '1234abcd#');

        Student::create([
            'student_id' => $newStudentId,
            'first_name' => $validatedData['first_name'],
            'second_name' => $validatedData['second_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'gender' => $validatedData['gender'],
            'status' => 'Registered',
            'batch' => $validatedData['batch'],
            'disability_status' => $validatedData['disability_status'] ?? 'No',
            'password' => $password,
        ]);

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
            $expectedHeaders = ['first_name', 'second_name', 'last_name', 'email', 'gender', 'batch', 'disability_status'];
            if (array_map('strtolower', $header) !== $expectedHeaders) {
                return redirect()->back()->with('error', 'Invalid CSV format. Ensure correct column names.');
            }

            for ($i = 1; $i < count($csvData); $i++) {
                $row = $csvData[$i];
                $lastStudent = Student::orderBy('student_id', 'desc')->first();
                $lastStudentId = $lastStudent ? substr($lastStudent->student_id, 3) : 0;
                $newStudentId = 'DMU' . str_pad($lastStudentId + 1, 7, '0', STR_PAD_LEFT);

                $password = Hash::make($row[2] . '1234abcd#');

                Student::create([
                    'student_id' => $newStudentId,
                    'first_name' => $row[0],
                    'second_name' => $row[1],
                    'last_name' => $row[2],
                    'email' => $row[3],
                    'gender' => $row[4],
                    'batch' => '1',
                    'status' => 'Registered',
                    'disability_status' => $row[6] ?? 'No',
                    'password' => $password,
                ]);
            }

            return redirect()->route('registrar.students')->with('success', 'Students uploaded successfully!');
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
=======
        $validated = $request->validate([
            'student_id' => 'required|string|max:50|unique:students',
            'first_name' => 'required|string|max:50',
            'second_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:students',
            'gender' => 'required|string|max:10',
            'disability_status' => 'required|string|max:10',
            'status' => 'required|string|max:10',
        ]);

        // Create the new student
        Student::create($validated);

        return redirect()->route('registrar.students')->with('success', 'Student registered successfully!');
    }

    // Handle student registration via file upload
    public function uploadStudents(Request $request)
    {
        // Validate the file
        $request->validate([
            'file' => 'required|mimes:csv|max:10240', // Limit to 10MB for CSV files
        ]);
    
        // Get the uploaded file
        $file = $request->file('file');
    
        // Open the CSV file
        $csvData = file($file->getRealPath());
    
        // Prepare an array to hold student data
        $students = [];
    
        // Loop through each row in the CSV and store data
        foreach ($csvData as $row) {
            $data = str_getcsv($row); // Convert CSV row into an array
    
            // Skip the header row
            if ($data[0] == 'student_id') {
                continue;
            }
    
            // Create a student array for insertion
               Student::create([
            'student_id' => $data[0],
            'first_name' => $data[1],
            'second_name' => $data[2],
            'last_name' => $data[3],
            'email' => $data[4],
            'gender' => $data[5],
            'disability_status' => $data[6],
            'status' => $data[7],
        ]);
        }
    
        // Insert the students into the database
        Student::insert($students);
    
        return redirect()->route('registrar.students')->with('success', 'Students uploaded successfully!');
    }
    
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
}
