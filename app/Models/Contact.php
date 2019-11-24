<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name' , 'user_id',
        'phone' , 'phone2',
        'email' , 'email2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
