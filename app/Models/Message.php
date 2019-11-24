<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name' , 'message',
        'email' , 'hotel_id', 'status'
    ];


    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
