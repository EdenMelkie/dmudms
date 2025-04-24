<?php
<<<<<<< HEAD
=======

>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $table      = 'students';
    protected $primaryKey = 'student_id';
    public $incrementing  = false;
    protected $keyType    = 'string';
    public $timestamps    = false;
=======
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276

    protected $fillable = [
        'student_id',
        'first_name',
        'second_name',
        'last_name',
        'email',
        'gender',
<<<<<<< HEAD
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

=======
        'disability_status',
        'status',
    ];
}
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
