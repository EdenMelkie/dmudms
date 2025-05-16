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
        $requests = Request::where('status', 'approved')
            ->join('employees', 'request.approved_by', '=', 'employees.employee_id')
            ->select(
                'request.*',
                'employees.first_name',
                'employees.second_name',
                'employees.last_name',
                'employees.email'
            )
            ->get();

        return view('maintainer.index', compact('requests'));
    }
}
