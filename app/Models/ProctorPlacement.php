<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProctorPlacement extends Pivot
{
    protected $table = 'proctor_placement';
    protected $primaryKey = 'placement_id';
    public $timestamps = false;

    protected $fillable = [
        'proctor_id',
        'year',
        'first_entry',
    ];

    // Define the relationship to the Proctor (Employee) model
    public function proctor()
    {
        return $this->belongsTo(Employee::class, 'proctor_id');
    }
}
