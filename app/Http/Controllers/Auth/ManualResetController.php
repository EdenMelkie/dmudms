<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ManualResetController extends Controller
{
    public function showForm()
    {
        return view('auth.passwords.custom-reset');
    }

    public function resetToDefault(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
        ]);

        // First, find the employee with matching ID and email
        $employee = Employee::where('employee_id', $request->username)
                            ->where('email', $request->email)
                            ->first();

        if (!$employee) {
            return back()->withErrors(['error' => 'No matching user found.']);
        }

        // Then find the corresponding user
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->withErrors(['error' => 'User record not found.']);
        }

        // Create a new password from last name
        $defaultPassword = $employee->last_name . '1234abcd#';

        // Update and save password
        $user->password = Hash::make($defaultPassword);
        $user->save();

        // Optionally log the generated password for development (REMOVE this in production)
        Log::info("Reset password for {$request->username} to: {$defaultPassword}");

        return redirect()->route('login')->with('status', 'Password reset to default. Please log in with the new password.');
    }
}
