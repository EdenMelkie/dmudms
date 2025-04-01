<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Fetch all notifications
        $notifications = Notification::all();

        // Return the notifications view with the data
        return view('directorate.notification', compact('notifications'));
    }
}
