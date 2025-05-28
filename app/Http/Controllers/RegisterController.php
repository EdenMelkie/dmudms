<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel; // if using Laravel Excel

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('employees.create');
    }


    public function uploadEmployees(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $data = array_map('str_getcsv', file($file->getRealPath()));

        if (count($data) < 2) {
            return redirect()->back()->withErrors(['file' => 'The CSV file is empty or has no data rows.']);
        }

        $header = array_map('trim', $data[0]);
        unset($data[0]); // Remove header

        $errors = [];

        foreach ($data as $index => $row) {
            if (count($row) !== count($header)) {
                $errors["Row " . ($index + 2)][] = 'Column mismatch with header.';
                continue;
            }

            $employeeData = array_combine($header, $row);
            $empId = $employeeData['employee_id'];

            $validator = Validator::make($employeeData, [
                'employee_id' => 'required|string|unique:employees,employee_id',
                'first_name' => 'required|string',
                'second_name' => 'required|string',
                'last_name' => 'required|string',
                'gender' => 'required|string|in:Male,Female',
                'email' => 'required|email|unique:employees,email',
                'phone' => 'required|string',
                'address' => 'required|string',
                'citizenship' => 'required|string',
                'role' => 'required|string|in:Directorate,Registrar,Maintenance,Admin,Proctor,Coordinator',
            ]);

            if ($validator->fails()) {
                $errors[$empId] = $validator->errors()->all();
                continue;
            }

            Employee::create([
                'employee_id' => $empId,
                'first_name' => $employeeData['first_name'],
                'second_name' => $employeeData['second_name'],
                'last_name' => $employeeData['last_name'],
                'gender' => $employeeData['gender'],
                'email' => $employeeData['email'],
                'phone' => $employeeData['phone'],
                'address' => $employeeData['address'],
                'citizenship' => $employeeData['citizenship'],
            ]);

            User::create([
                'username' => $empId,
                'password' => Hash::make($employeeData['last_name'] . '1234abcd#'),
                'role' => $employeeData['role'],
                'status' => 'active',
            ]);
        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors(['upload_errors' => $errors])->withInput();
        }

        return redirect()->route('employees.index')->with('success', 'Employees uploaded and registered successfully.');
    }


    public function resetPassword($id)
    {
        $employee = Employee::findOrFail($id);

        // Generate new password: last_name + "1234abcd#"
        $rawPassword = $employee->last_name . '1234abcd#';

        $user = User::findOrFail($id);
        // Hash and update
        $user->password = bcrypt($rawPassword);
        $user->save();

        return redirect()->route('employees.index')
            ->with('success', "Password for {$employee->first_name} {$employee->last_name} has been reset.");
    }


    public function index(Request $request)
    {
        $query = Employee::query(); // Start a base query

        if ($request->has('search') && $request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('employee_id', 'LIKE', "%{$search}%")
                    ->orWhere('first_name', 'LIKE', "%{$search}%")
                    ->orWhere('second_name', 'LIKE', "%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('address', 'LIKE', "%{$search}%")
                    ->orWhere('citizenship', 'LIKE', "%{$search}%");
            });
        }

        $employees = $query->get(); // Execute the query

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|string|unique:employees,employee_id',
            'first_name' => 'required|string|max:50',
            'second_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'gender' => 'required|string|max:10',
            'email' => 'required|email|max:50|unique:employees,email',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:50',
            'citizenship' => 'required|string|max:50',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }


    public function edit($employee_id)
    {
        $employee = Employee::where('employee_id', $employee_id)->firstOrFail();
        return view('employees.edit', compact('employee'));
    }


    public function destroy($employee_id)
    {
        $employee = Employee::where('employee_id', $employee_id)->firstOrFail();
        $user = User::where('username', $employee_id)->first();

        // Delete both records from employees and users table
        if ($user) {
            $user->delete();
        }
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }



    public function register(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'employee_id' => 'required|string|unique:employees,employee_id',
            'last_name' => 'required|string|max:255',
        ]);

        /*
    // Auto-generate employee ID - now commented out
    $lastEmployee = Employee::orderBy('employee_id', 'desc')->first();
    $lastEmployeeId = $lastEmployee ? (int) substr($lastEmployee->employee_id, 3) : 0;
    $emp = 'Emp' . str_pad($lastEmployeeId + 1, 4, '0', STR_PAD_LEFT);

    while (Employee::where('employee_id', $emp)->exists()) {
        $lastEmployeeId++;
        $emp = 'Emp' . str_pad($lastEmployeeId + 1, 4, '0', STR_PAD_LEFT);
    }
    */

        // Use provided employee_id instead of auto-generated
        $emp = $request->employee_id;

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'second_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|string|max:10',
            'email' => 'required|string|email|unique:employees,email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'citizenship' => 'required|string',
            'role' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $password = Hash::make($validatedData['last_name'] . '1234abcd#');

        // Insert into the employees table
        $employee = Employee::create([
            'employee_id' => $emp,
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'citizenship' => $request->citizenship,
        ]);

        // Insert into the users table
        $user = User::create([
            'username' => $emp,
            'password' => $password,
            'role' => $request->role,
            'status' => 'active',
        ]);

        return redirect()->route('employees.index')->with('success', 'Account created successfully.');
    }


    public function update(Request $request, $employee_id)
    {
        $employee = Employee::where('employee_id', $employee_id)->firstOrFail();

        $request->validate([
            'first_name' => 'required|string',
            'second_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:employees,email,' . $employee->employee_id . ',employee_id',
            'phone' => 'required|string',
            'address' => 'required|string',
            'citizenship' => 'required|string',
        ]);

        $employee->update([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'citizenship' => $request->citizenship,
        ]);

        return redirect()->route('employees.index')->with('success', 'Account updated successfully.');
    }

    public function viewEmployees()
    {
        $employees = Employee::join('users', 'employees.employee_id', '=', 'users.username')
            ->select('employees.*', 'users.role', 'users.status')
            ->get();

        return view('employees.index', compact('employees'));
    }


    public function show($employee_id)
    {
        $employee = Employee::join('users', 'employees.employee_id', '=', 'users.username')
            ->select('employees.*', 'users.role', 'users.status')
            ->where('employees.employee_id', $employee_id)
            ->firstOrFail();

        return view('employees.show', compact('employee'));
    }

    public function resetAccount()
    {
        // Fetch all employees
        $employees = Employee::all();

        foreach ($employees as $employee) {
            // Ensure employee is linked to a user
            $user = User::where('username', $employee->employee_id)->first(); // or match by user_id if available

            if ($user) {
                $newPassword = $employee->last_name . '1234abcd#';
                $user->password = Hash::make($newPassword);
                $user->save();
            }
        }

        return view('employees.index', compact('employees'))
            ->with('success', 'Passwords reset for all employees.');
    }

    public function resetSingleEmployeePassword($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        $user = User::where('username', $employee->employee_id)->first(); // or use relation

        if ($user) {
            $newPassword = $employee->last_name . '1234abcd#';
            $user->password = Hash::make($newPassword);
            $user->save();

            return back()->with('success', "Password reset for {$employee->first_name}.");
        }

        return back()->with('error', "User account not found for employee.");
    }


    public function reset()
    {
        $employees = Employee::all(); // Fetch all employees from the database
        return view('admin.reset_account', compact('employees')); // Pass data to the view
    }
}
