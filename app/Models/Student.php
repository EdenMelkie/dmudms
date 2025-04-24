<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table      = 'students';
    protected $primaryKey = 'student_id';
    public $incrementing  = false;
    protected $keyType    = 'string';
    public $timestamps    = false;

    protected $fillable = [
        'student_id',
        'first_name',
        'second_name',
        'last_name',
        'email',
        'gender',
        'batch',
        'disability_status',
        'status',
        'password',
    ];

     // Define the placement relationship
     public function placement()
     {
         return $this->hasOne(StudentPlacement::class, 'student_id', 'student_id');
     }
}

