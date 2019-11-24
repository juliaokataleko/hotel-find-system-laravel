<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $fillable = [
        'desc' , 'user_id',
        'kind' , 'valueM', 'objId'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
