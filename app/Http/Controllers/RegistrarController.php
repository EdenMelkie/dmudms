<?php
namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Student;

class RegistrarController extends Controller
{
    public function index() {
        return view('registrar.index');
    }

    public function showStudents() {
        $students = Student::all(); // Fetch all students
        return view('registrar.students.index', compact('students'));
    }

    public function editStudent($id) {
        $student = Student::findOrFail($id);
        return view('registrar.students.edit', compact('student'));
    }

    public function updateStudent(Request $request, $id) {
        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('registrar.students')->with('success', 'Student updated successfully!');
    }

    public function deleteStudent($id) {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('registrar.students')->with('success', 'Student deleted successfully!');
    }

    // Show registration form
    public function showRegistrationForm()
    {
        return view('registrar.students.register');
    }

    // Store student from manual registration form
    public function storeStudent(Request $request)
    {
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
    
}
