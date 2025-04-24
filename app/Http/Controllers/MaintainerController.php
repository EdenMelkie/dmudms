<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintainerController extends Controller
{
    /**
     * Display the maintainer page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Your code for the maintainer page
        return view('maintainer.index');
    }
}
