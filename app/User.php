<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description', 'email', 'password', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function precedents()
    {
        return $this->hasMany(Precedent::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function saves()
    {
        return $this->hasMany(Precedent::class);
    }

}
