<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    // Display all blocks
    public function index()
    {
        $blocks = Block::all(); // Retrieve all blocks from the database
        return view('directorate.blocks.index', compact('blocks'));
    }

    // Show the form to create a new block
    public function create()
    {
        return view('directorate.blocks.create');
    }

    // Store a newly created block
    public function store(Request $request)
    {
        $request->validate([
            'block_id' => 'required|string|max:10',
            'disable_group' => 'required|string|max:10',
            'status' => 'required|string|max:10',
            'capacity' => 'required|Integer',
            'reserved_for' => 'required|string|max:10',
        ]);

        Block::create([
            'block_id' => $request->block_id,
            'disable_group' => $request->disable_group,
            'status' => $request->status,
            'capacity' => $request->capacity,
            'reserved_for' => $request->reserved_for,
        ]);

        return redirect()->route('directorate.blocks')->with('success', 'Block created successfully.');
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
