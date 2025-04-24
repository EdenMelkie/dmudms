<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'room'; // Explicitly set the table name

    protected $primaryKey = ['room_id', 'block'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'room_id',
        'block',
        'status',
        'capacity'
    ];

    public function blockRelation()
    {
        return $this->belongsTo(Block::class, 'block', 'block_id');
    }

    public function placements()
    {
        return $this->hasMany(StudentPlacement::class, 'room', 'room_id')
                   ->whereColumn('student_placement.block', 'room.block');
    }
}