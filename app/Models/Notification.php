<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
 
=======

>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
class Notification extends Model
{
    use HasFactory;

    protected $table = 'notification';
    protected $primaryKey = 'notification_id';
    public $timestamps = false;

    protected $fillable = [
        'registrar_id',
        'message',
        'status',
        'date',
    ];
<<<<<<< HEAD


public function user()
{
    return $this->belongsTo(User::class, 'registrar_id', 'username');
}


}
=======
}
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
