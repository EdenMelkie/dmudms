<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
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
            'email' => 'required|email|max:50|unique:employees,email',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:50',
            'citizenship' => 'required|string|max:50',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }


    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }
    public function update(Request $request, $employee_id)
    {
        $employee = Employee::findOrFail($employee_id);

        // Validate and update the employee data
        $employee->update($request->all());

        return redirect()->route('employees.index');
    }


    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function resetAccount()
    {
        // Assuming Employee is your model
        $employees = Employee::all();  // Fetch all employees, or apply any necessary filters
        return view('admin.reset_account', compact('employees'));  // Pass the $employees variable to the view
    }
}