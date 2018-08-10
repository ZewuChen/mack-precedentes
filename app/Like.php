<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id', 'like_id',
    ];
    
    public function like()
    {
        return $this->morphTo();
    }
}
