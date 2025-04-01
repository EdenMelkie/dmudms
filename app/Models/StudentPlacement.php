<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPlacement extends Model
{
    use HasFactory;

    protected $table = 'student_placement';
    protected $primaryKey = 'placement_id';
    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'block',
        'room',
        'status',
        'year',
    ];
}