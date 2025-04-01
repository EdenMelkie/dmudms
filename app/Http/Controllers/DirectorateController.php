<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirectorateController extends Controller
{
    // Method to show the reports page
    public function notify()
    {
        return view('directorate.notification'); // The view we will create next
    }
}