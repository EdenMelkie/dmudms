<?php 


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as RequestModel; // Assume model name is RequestModel
use Carbon\Carbon;

class RequestController extends Controller
{
    public function create()
    {
        return view('requests.create'); // Blade form
    }

    public function store(Request $request)
    {
        // Validate only the message field from the user
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        // Auto-fill the rest from session and current date
        RequestModel::create([
            'student_id'   => session('username'),
            'message'      => $validated['message'],
            'status'       => 'pending',
            'request_date' => Carbon::now(), // or date('Y-m-d')
            
        ]);

        return redirect()->back()->with('success', 'Request submitted successfully!');
    }

}
