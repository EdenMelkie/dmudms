<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
<<<<<<< HEAD
    public function index(Request $request)
    {
        $query = Notification::with('user.employee'); // nested eager loading
    
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
    
        $notifications = $query->orderBy('date', 'desc')->get();
    
        // Mark all as read
        foreach ($notifications as $notification) {
            if ($notification->status === 'Unread') {
                $notification->update(['status' => 'Read']);
            }
        }
    
        return view('directorate.notification', compact('notifications'));
    }
    
      
=======
    public function index()
    {
        // Fetch all notifications
        $notifications = Notification::all();

        // Return the notifications view with the data
        return view('directorate.notification', compact('notifications'));
    }
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
}
