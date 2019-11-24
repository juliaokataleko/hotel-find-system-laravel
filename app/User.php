<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function provinces()
    {
        return $this->hasMany(Province::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
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

    public function resourcs()
    {
        return $this->hasMany(Resourc::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function finances()
    {
        return $this->hasMany(Finance::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

}
