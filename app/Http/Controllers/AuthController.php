<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
    
        // Fetch user using Query Builder
        $user = DB::table('users')->where('username', $request->username)->first();
    
        // Check if user exists and verify password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Invalid username or password')->withInput();
        }
    
        // Store user details in session
        session([
            'username'  => $user->username,
            'userType'  => $user->role
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
    

    public function logout(Request $request)
    {
        // Auth::logout(); // Log out the authenticated user
        Session::flush(); // Clear all session data
        Session::regenerate(); // Regenerate the session ID
        return redirect()->route('home');
    }
}