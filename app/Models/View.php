<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = [
        'platform', 'ip' , 'hotel_id'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
