<?php

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/available-rooms', function(Request $request) {
    $validated = $request->validate([
        'block' => 'required|exists:block,block_id',
        'gender' => 'nullable|string',
        'disability' => 'nullable|string'
    ]);

    $query = Room::with(['blockRelation', 'placements'])
        ->where('block', $validated['block'])
        ->whereIn('status', ['Free', 'Partially Occupied']);

    // Filter by gender if specified
    if (!empty($validated['gender'])) {
        $query->whereHas('blockRelation', function($q) use ($validated) {
            $q->where('reserved_for', $validated['gender'])
              ->orWhereNull('reserved_for');
        });
    }

    // Filter by disability status
    if (!empty($validated['disability'])) {
        $query->whereHas('blockRelation', function($q) use ($validated) {
            if ($validated['disability'] === 'Yes') {
                $q->where('disability_group', 'Yes');
            } else {
                $q->where('disability_group', '!=', 'Yes')
                  ->orWhereNull('disability_group');
            }
        });
    }

    $rooms = $query->get()->map(function($room) {
        $occupancy = $room->placements->count();
        return [
            'room_id' => $room->room_id,
            'status' => $room->status,
            'capacity' => $room->capacity,
            'available_beds' => $room->capacity - $occupancy
        ];
    });

    return response()->json($rooms);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
