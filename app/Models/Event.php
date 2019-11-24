<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    public function __contruct() {
        if(is_null(Auth::user()->hotel_id) && Auth::user()->role > 1) {
            
        }
    }

    protected $fillable = [
        'name' , 'user_id',
        'desc' , 'hotel_id',
        'dateevent' , 'image', 
        'price', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
