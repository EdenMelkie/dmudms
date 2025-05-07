<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    // Display all blocks
   
    public function index()
    {
        // Fetch blocks with rooms and assigned proctors
        $blocks = Block::with(['rooms', 'assignedStudents', 'assignedProctors'])->get();
        return view('directorate.blocks.index', compact('blocks'));
    }
    

    // Show the form to create a new block
    public function create()
    {
        return view('directorate.blocks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'disable_group' => 'required|string|max:10',
            'status' => 'required|string|max:10',
            'capacity' => 'required|integer',
            'reserved_for' => 'required|string|max:10',
        ]);

        // Auto-generate block_id like B001, B002, etc.
        $latestBlock = Block::orderByDesc('block_id')->first();
        $lastNumber = 0;

        if ($latestBlock) {
            // Extract the number from block_id
            $lastNumber = (int) substr($latestBlock->block_id, 1);
        }

        $newBlockId = 'B' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // Create the block
        $block = Block::create([
            'block_id' => $newBlockId,
            'disable_group' => $request->disable_group,
            'status' => $request->status,
            'capacity' => $request->capacity,
            'reserved_for' => $request->reserved_for,
        ]);


        // Create rooms based on the block's capacity
        for ($i = 1; $i <= $block->capacity; $i++) {
            // Use the room_id (i) and block to insert the room with a composite key
            DB::table('room')->insert([
                'room_id' => $i,  // Room number within the block
                'block' => $block->block_id,  // Block ID
                'status' => 'free',  // Default status
            ]);
        }

        return redirect()->route('directorate.blocks')->with('success', 'Block and rooms created successfully.');
    }



    // Show the form to edit an existing block
    public function edit($id)
    {
        $block = Block::findOrFail($id);
        return view('directorate.blocks.edit', compact('block'));
    }

    // Update the block data
    public function update(Request $request, $id)
    {
        $request->validate([
            'block_id' => 'required|string|max:10',
            'disable_group' => 'nullable|string|max:10',
            'status' => 'required|string|max:10',
            'capacity' => 'required|Integer',
            'reserved_for' => 'required|string|max:10',
        ]);

        $block = Block::findOrFail($id);
        $block->update([
            'block_id' => $request->block_id,
            'disable_group' => $request->disable_group,
            'status' => $request->status,
            'capacity' => $request->capacity,
            'reserved_for' => $request->reserved_for,
        ]);

        return redirect()->route('directorate.blocks')->with('success', 'Block updated successfully.');
    }

    // Delete a block
    public function destroy($id)
    {
        $block = Block::findOrFail($id);
        $block->delete();

        return redirect()->route('directorate.blocks')->with('success', 'Block deleted successfully.');
    }
}
