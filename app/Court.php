<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    public function precedents()
    {
        return $this->hasMany(Precedent::class);
    }

    public function scopeOrdered($query)
    {
    	return $query->orderBy('name');
    }
}
