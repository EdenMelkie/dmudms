<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'username';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'employee_id', 'username');
    }
}