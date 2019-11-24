<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Province;

class City extends Model
{
    protected $fillable = [
        'name', 'province_id', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

}
