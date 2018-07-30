<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function precedents()
    {
        return $this->belongsToMany(Precedent::class)->withTimestamps();
    }
}
