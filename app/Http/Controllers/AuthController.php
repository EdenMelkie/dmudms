<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check the users table first
        $user = DB::table('users')->where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Store user details in session
            Auth::loginUsingId($user->username); // Log the user in

            session([
                'username' => $user->username,
                'userType' => $user->role
            ]);

            // Redirect based on user role
            return match ($user->role) {
                'Admin'       => redirect()->route('admin'),
                'Proctor'     => redirect()->route('proctor'),
                'Directorate' => redirect()->route('directorate'),
                'Coordinator' => redirect()->route('coordinator'),
                'Student'     => redirect()->route('student'),
                'Maintenance' => redirect()->route('maintenance'),
                'Registrar'   => redirect()->route('registrar'),
                default       => redirect()->route('login'),
            };
        }

        // If not found in users, check the students table
        $student = DB::table('students')->where('student_id', $request->username)->first();

        if ($student && Hash::check($request->password, $student->password)) {
            Auth::loginUsingId($student->student_id); // Log the student in
            session([
                'username' => $student->student_id,
                'userType' => 'Student'
            ]);

            return redirect()->route('student');
        }

        // If no match is found, return error
        return redirect()->back()->with('error', 'Invalid username or password')->withInput();
    }

    public function logout(Request $request)
    {
        // Clear all session data
        session()->forget('userType');
        session()->forget('username');
        session()->flush();
    
        // Logout the user from Auth
        Auth::logout();
    
        // Redirect the user to the login page after logout
        return redirect()->route('login');
    }
    
    
}
