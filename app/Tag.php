<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 'slug',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function precedents()
    {
        return $this->belongsToMany(Precedent::class)->withTimestamps();
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }
}
