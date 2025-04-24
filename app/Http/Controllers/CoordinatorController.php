<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinatorController extends Controller
{ 
        // Show all assignments
        public function viewAssignments()
        {
            // Fetch assignments from database (example)
            $assignments = \App\Models\ProctorPlacement::all();
            
            return view('coordinator.placement', compact('assignments'));
        }
    
        // Manage Proctors (This could display a list of proctors)
        public function manageProctors()
        {
            // Fetch proctors from the database (example)
            $proctors = \App\Models\ProctorPlacement::all();
            
            return view('coordinator.proctor', compact('proctors'));
        }
    
        // View Blocks (This could display blocks in a dormitory)
        public function viewBlocks()
        {
            // Fetch blocks from the database (example)
            $blocks = \App\Models\Block::all();
            
            return view('coordinator.blocks', compact('blocks'));
        }
    
        // Assign Proctors (This could show a form to assign proctors)
        public function assignProctors()
        {
            // Fetch available rooms or proctors to assign (example)
            $rooms = \App\Models\Room::where('status', 'free')->get();
            $proctors = \App\Models\ProctorPlacement::all();
            
            return view('coordinator.assign', compact('rooms', 'proctors'));
        }
    }
    