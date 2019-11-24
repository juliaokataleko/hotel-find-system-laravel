<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resourc extends Model
{
    protected $fillable = [
        'name' , 'user_id','hotel_id'
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
