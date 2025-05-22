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

    public function index()
    {
        $requests = StudentRequest::where('student_id', session('username'))->get();
        return view('placement.replacement', compact('requests'));
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


    public function store1(Request $request)
    {
        StudentRequest::create([
            'student_id' => session('username'),
            'message' => $request->message,
            'status' => 'pending',
            'request_date' => now(),
            'approved_by' => null,
            'approved_date' => null,
        ]);

        return redirect()->route('replacements.index')->with('success', 'Request submitted!');
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

    public function edit($id)
{
    $request = StudentRequest::findOrFail($id);
    return view('placement.edit', compact('request'));
}

    public function update(Request $request, $id)
    {
        $req = StudentRequest::findOrFail($id);

        if ($req->student_id !== session('username')) {
            abort(403);
        }

        $req->update([
            'message' => $request->message,
        ]);

        return redirect()->route('replacements.index')->with('success', 'Request updated successfully.');
    }

    public function destroy($id)
    {
        $req = StudentRequest::findOrFail($id);

        if ($req->student_id !== session('username')) {
            abort(403);
        }

        $req->delete();

        return redirect()->route('replacements.index')->with('success', 'Request deleted successfully.');
    }
}
