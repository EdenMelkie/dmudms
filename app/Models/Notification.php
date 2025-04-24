<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
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


public function user()
{
    return $this->belongsTo(User::class, 'registrar_id', 'username');
}


}
