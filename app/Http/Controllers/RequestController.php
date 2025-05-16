<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as StudentRequest; // Assume model name is RequestModel
use Carbon\Carbon;

class RequestController extends Controller
{
    public function create()
    {
        return view('requests.create'); // Blade form
    }

    public function approveRequest(Request $req)
    {
        $requestId = $req->request_id;
        $request = StudentRequest::find($requestId);

        if (!$request) {
            return redirect()->back()->with('error', 'Request not found.');
        }

        if ($request->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending requests can be approved.');
        }

        $request->status = 'approved';
        $request->approved_by = session('username');
        $request->approved_date = now();
        $request->save();

        return redirect()->back()->with('success', 'Request approved successfully.');
    }


    public function store(Request $request)
    {
        // Validate only the message field from the user
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        // Auto-fill the rest from session and current date
        StudentRequest::create([
            'student_id'   => session('username'),
            'message'      => $validated['message'],
            'status'       => 'pending',
            'request_date' => Carbon::now(), // or date('Y-m-d')

        ]);

        return redirect()->back()->with('success', 'Request submitted successfully!');
    }
}
