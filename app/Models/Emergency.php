<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergency extends Model
{
    use HasFactory;

    protected $table = 'emergency';
    protected $primaryKey = 'emergence_id';
    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'father_name',
        'grand_father',
        'grand_grand_father',
        'phone',
        'region',
        'woreda',
        'kebele',
        'mother_name',
    ];
}