<?php

// app/Http/Controllers/ProctorController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProctorController extends Controller
{
    public function viewRooms()
    {
        // Logic to view rooms, for example, fetching room data from the database
        return view('proctor.viewRooms');
    }
}