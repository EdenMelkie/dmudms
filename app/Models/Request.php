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
        'image_path',
        'type',
    ];

     public function student()
    {
        return $this->hasOne(Student::class, 'student_id', 'student_id');
    }

      public function placed()
    {
        return $this->hasOne(StudentPlacement::class, 'student_id', 'student_id');
    }
}