<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'name', 'slug', 'user_id'    
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
