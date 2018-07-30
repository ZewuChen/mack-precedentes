<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Collection extends Model
{
    public $fillable = ['name', 'slug', 'is_public', 'user_id'];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function precedents()
    {
        return $this->belongsToMany(Precedent::class)->withTimestamps();
    }

    public function scopeOrdered($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function has(Precedent $precedent, Collection $collection)
    {
        
        $contain = $precedent->collections->contains($collection); 

        return $contain;
    }
}
