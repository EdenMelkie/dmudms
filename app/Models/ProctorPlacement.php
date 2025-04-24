<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProctorPlacement extends Pivot
{
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProctorPlacement extends Model
{
    use HasFactory;

>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
    protected $table = 'proctor_placement';
    protected $primaryKey = 'placement_id';
    public $timestamps = false;

    protected $fillable = [
        'proctor_id',
        'year',
        'first_entry',
    ];
<<<<<<< HEAD

    // Define the relationship to the Proctor (Employee) model
    public function proctor()
    {
        return $this->belongsTo(Employee::class, 'proctor_id');
    }
}
=======
}
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
