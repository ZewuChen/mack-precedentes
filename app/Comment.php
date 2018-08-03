<?php

namespace App;

use App\Traits\WithSlug;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use WithSlug;
    
    protected $fillable = [
        'body', 'slug', 'file', 'is_approved', 'precedent_id', 'user_id'
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

    public function isApproved()
    {
        return $this->is_approved;
    }
}
