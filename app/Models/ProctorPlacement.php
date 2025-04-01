<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProctorPlacement extends Model
{
    use HasFactory;

    protected $table = 'proctor_placement';
    protected $primaryKey = 'placement_id';
    public $timestamps = false;

    protected $fillable = [
        'proctor_id',
        'year',
        'first_entry',
    ];
}