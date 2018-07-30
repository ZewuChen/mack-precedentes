<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'body', 'slug', 'file', 'precedent_id', 'user_id', 'status'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function precedent()
    {
        return $this->belongsTo(Precedent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
