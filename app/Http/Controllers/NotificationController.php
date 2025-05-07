<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
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
    
      
}
