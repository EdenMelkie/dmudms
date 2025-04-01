<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|string|unique:employees,employee_id',
            'first_name' => 'required|string',
            'second_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:employees,email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'citizenship' => 'required|string',
            'role' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Insert into the employees table
        $employee = Employee::create([
            'employee_id' => $request->employee_id,
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'citizenship' => $request->citizenship,
        ]);

        // Insert into the users table
        $user = User::create([
            'username' => $request->employee_id,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'active', // Set a default status
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function edit($employee_id)
    {
        $employee = Employee::where('employee_id', $employee_id)->firstOrFail();
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, $employee_id)
    {
        $employee = Employee::where('employee_id', $employee_id)->firstOrFail();

        $request->validate([
            'first_name' => 'required|string',
            'second_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:employees,email,' . $employee->id,
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

        return redirect()->route('dashboard')->with('success', 'Account updated successfully.');
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
            ->get();

        return view('employees.show', compact('employee'));
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

    public function resetAccount()
    {
        // Assuming Employee is your model
        $employees = Employee::all();  // Fetch all employees, or apply any necessary filters
        return view('admin.reset_account', compact('employees'));  // Pass the $employees variable to the view
    }

    public function reset()
    {
        $employees = Employee::all(); // Fetch all employees from the database
        return view('admin.reset_account', compact('employees')); // Pass data to the view
    }
}