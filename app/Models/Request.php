<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = 'request';
    protected $primaryKey = 'request_id';
    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'message',
        'status',
        'request_date',
        'approved_by',
        'approved_date',
    ];
}