<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $table = 'block';
    protected $primaryKey = 'block_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'block_id',
        'disable_group',
        'status',
        'capacity',
        'reserved_for',
    ];
    // app/Models/Block.php

    // app/Models/Block.php
    public function rooms()
    {
        return $this->hasMany(Room::class, 'block', 'block_id');
    }

   // In Block.php model

   public function assignedProctors()
   {
       return $this->belongsToMany(Employee::class, 'proctor_placement', 'block', 'proctor_id')
                   ->using(ProctorPlacement::class)  // Ensure you're using the custom pivot model
                   ->withPivot('proctor_id', 'year', 'first_entry');  // If you need these attributes from the pivot table
   }   

    public function assignedStudents()
{
    return $this->hasMany(\App\Models\StudentPlacement::class, 'block', 'block_id');
}

}
