<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materials';
    protected $primaryKey = 'registration_id';
    public $timestamps = false;

    protected $fillable = [
        'block',
        'room',
        'unlocker',
        'locker',
        'chair',
        'pure_foam',
        'damaged_foam',
        'tiras',
        'tables',
        'chibud',
    ];
}