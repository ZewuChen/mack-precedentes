<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name', 'description', 'email', 'password', 'photo',
    ];

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
        return $this->belongsToMany(Precedent::class)->withTimestamps();
    }

    public function hasSaved(Precedent $precedent)
    {
        return $this->saves->contains($precedent);
    }
}
