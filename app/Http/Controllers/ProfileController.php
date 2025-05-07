<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Employee;

class ProfileController extends Controller
{
    public function edit()
    {
        // In your controller
        $layouts = [
            'Admin' => 'layouts.appadd',
            'Proctor' => 'layouts.appproc',
            'Coordinator' => 'layouts.appcoordinator',
            'Student' => 'layouts.appstd',
            'Registrar' => 'layouts.appregistrar',
            'Directorate' => 'layouts.appdirectorate',
            'Maintenance' => 'layouts.appmain',

        ];

        $layout = $layouts[session('userType')] ?? 'layouts.default'; // Use a default layout if not recognized


        // Manually set the employee_id for now (can be changed for testing)
        $employee_id = session('username'); // Replace this with your desired employee ID

        // Fetch the corresponding employee details using employee_id
        $employee = Employee::where('employee_id', $employee_id)->first();

        // Get the authenticated user
        $user = Auth::user();

        // Pass the user and employee data to the view
        return view('profile.edit', compact('user', 'employee'))->with('layout', $layout);
    }

    public function update(Request $request)
    {
        // Use a static employee_id 'Emp5'
        $employee_id = session('username'); // Replace this with your desired employee ID

        // Fetch the employee details using employee_id
        $employee = Employee::where('employee_id', $employee_id)->first();

        if (!$employee) {
            // Handle the case where the employee with this ID doesn't exist
            return redirect()->back()->with('error', 'Employee not found.');
        }

        // Validate the input data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'second_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|unique:employees,email,' . $employee->employee_id . ',employee_id',
            'phone' => 'required|digits_between:10,15',
            'address' => 'required|string|max:50',
            'citizenship' => 'required|string|max:50',
            'username' => 'required|string|max:50',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update employee details
        $employee->update([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'citizenship' => $request->citizenship,
        ]);

        // If password is provided, update the password (optional)
        if ($request->filled('password')) {
            $employee->user()->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Redirect back with a success message
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
