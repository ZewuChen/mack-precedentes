<?php

namespace App;

use App\Traits\WithSlug;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use WithSlug;
    
    protected $fillable = [
        'name', 'slug',
    ];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function precedents()
    {
        return $this->hasMany(Precedent::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('name');
    }
}
