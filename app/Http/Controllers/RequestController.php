<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as StudentRequest; // Assume model name is RequestModel
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    public function create()
    {
        $studentId = session('username');

        $requests = StudentRequest::where('student_id', $studentId)
            ->where('type', 'maintenance')
            ->orderBy('request_date', 'desc')
            ->get();

        return view('requests.create', compact('requests'));
    }

    public function markAsDone($id)
    {
        $request = StudentRequest::findOrFail($id);

        if ($request->status !== 'approved') {
            return redirect()->back()->with('error', 'Only approved requests can be marked as done.');
        }

        $request->status = 'done';
        $request->save();

        return redirect()->back()->with('success', 'Request marked as done successfully.');
    }

    public function index()
    {
        $requests = StudentRequest::where('student_id', session('username'))
            ->where('type', 'replacement')
            ->get();
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

    public function viewApprovedReplacements()
    {
        $requests = StudentRequest::with(['student', 'placed'])
            ->where('status', 'approved')
            ->where('type', 'replacement')
            ->orderByDesc('request_date')
            ->get();

        return view('directorate.view_requests', compact('requests'));
    }

    public function store1(Request $request)
    {
        $studentId = session('username');

        // Check if the student has a placement
        $hasPlacement = DB::table('student_placement')
            ->where('student_id', $studentId)
            ->exists();

        if (!$hasPlacement) {
            return redirect()->route('replacements.index')
                ->with('error', 'Only assigned students can submit a replacement request.');
        }

        // Validate inputs
        $validated = $request->validate([
            'message' => 'required|string|max:400',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/requests'), $imageName);
            $imagePath = 'uploads/requests/' . $imageName;
        }

        // Create the replacement request
        StudentRequest::create([
            'student_id'     => $studentId,
            'message'        => $validated['message'],
            'status'         => 'pending',
            'request_date'   => now(),
            'approved_by'    => null,
            'approved_date'  => null,
            'type'           => 'replacement',
            'image_path'     => $imagePath, // <-- Ensure this column exists in your table
        ]);

        return redirect()->route('replacements.index')->with('success', 'Request submitted!');
    }


    public function store(Request $request)
    {
        $studentId = session('username');

        // Check if the student has a placement
        $hasPlacement = DB::table('student_placement')
            ->where('student_id', $studentId)
            ->exists();

        if (!$hasPlacement) {
            return redirect()->back()->with('error', 'Only assigned students can submit a request.');
        }

        // Validate the message and image
        $validated = $request->validate([
            'message' => 'required|string|max:400',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Accepts image
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/requests'), $imageName);
            $imagePath = 'uploads/requests/' . $imageName;
        }

        // Create the request
        StudentRequest::create([
            'student_id'   => $studentId,
            'message'      => $validated['message'],
            'status'       => 'pending',
            'type'         => 'maintenance',
            'request_date' => Carbon::now(),
            'image_path'   => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Request submitted successfully!');
    }


    public function edit($id)
    {
        $request = StudentRequest::findOrFail($id);
        return view('placement.edit', compact('request'));
    }

    public function edit1($id)
    {
        $request = StudentRequest::findOrFail($id);
        return view('requests.edit', compact('request'));
    }

    public function update(Request $request, $id)
    {
        $req = StudentRequest::findOrFail($id);

        // Check if the logged-in user is the owner
        if ($req->student_id !== session('username')) {
            abort(403);
        }

        // Validate input
        $validated = $request->validate([
            'message' => 'required|string|max:400',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Prepare update data
        $updateData = [
            'message' => $validated['message'],
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($req->image_path && file_exists(public_path($req->image_path))) {
                unlink(public_path($req->image_path));
            }

            // Save new image
            $imageName = time() . '_' . uniqid() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/requests'), $imageName);
            $updateData['image_path'] = 'uploads/requests/' . $imageName;
        }

        // Update the request
        $req->update($updateData);

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

    public function update1(Request $request, $id)
    {
        $req = StudentRequest::findOrFail($id);

        // Check if the logged-in user is the owner
        if ($req->student_id !== session('username')) {
            abort(403);
        }

        // Validate input
        $validated = $request->validate([
            'message' => 'required|string|max:400',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Prepare update data
        $updateData = [
            'message' => $validated['message'],
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($req->image_path && file_exists(public_path($req->image_path))) {
                unlink(public_path($req->image_path));
            }

            // Save new image
            $imageName = time() . '_' . uniqid() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('uploads/requests'), $imageName);
            $updateData['image_path'] = 'uploads/requests/' . $imageName;
        }

        // Update the request
        $req->update($updateData);

        return redirect()->route('requests.create')->with('success', 'Request updated successfully.');
    }
}
