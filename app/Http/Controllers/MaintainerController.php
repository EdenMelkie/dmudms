<?php

namespace App\Http\Controllers;

use App\Models\Request; // Import the Request model for the 'request' table

class MaintainerController extends Controller
{
    /** 
     * Display the maintainer page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all the requests from the database
        $requests = Request::all(); // Use the Request model (your custom model)

        // Return the view with the fetched data
        return view('maintainer.index', compact('requests'));
    }
}
