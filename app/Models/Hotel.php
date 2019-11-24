<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name', 'province_id', 'city_id','user_id',
        'address', 'phone1', 'phone2',
        'email', 'facebook', 'instagram', 'website',
        'address', 'phone1', 'phone2',
        'category', 'about', 'image', 'map', 'slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
    
    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function resourcs()
    {
        return $this->hasMany(Resourc::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

}
