<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name'
    ];
    
    public function precedents()
    {
        return $this->hasMany(Precedent::class, 'branch_id');
    }

}
