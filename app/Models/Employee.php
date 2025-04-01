<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'employee_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'first_name',
        'second_name',
        'last_name',
        'email',
        'phone',
        'address',
        'citizenship',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'username');
    }
}