<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrecedentType extends Model
{
    public function precedents()
    {
        return $this->hasMany(Precedent::class, 'type_id');
    }

    public function scopeOrdered($query)
    {
    	return $query->orderBy('name');
    }
}
