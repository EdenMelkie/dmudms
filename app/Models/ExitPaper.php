<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExitPaper extends Model
{
    use HasFactory;

    protected $table = 'exit_paper';
    protected $primaryKey = 'exit_id';
    public $timestamps = false;

    protected $fillable = [
        'stud_id',
        'request_date',
        'approved_date',
        'type',
        'color',
        'number',
    ];
}