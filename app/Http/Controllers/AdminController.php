<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the Create Account page.
     */
    public function create()
    {
        return view('admin.create_account');
    }

    /**
     * Show the Update Account page.
     */
    public function update()
    {
        return view('admin.update_account');
    }

    /**
     * Show the Reset Account page.
     */
    public function reset()
    {
        return view('admin.reset_account');
    }
}