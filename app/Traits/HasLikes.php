<?php

namespace App\Traits;

use App\Like;
use App\User;

trait HasLikes
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'like');
    }

    public function isLikedBy(User $user)
    {
        return $this->likes->where('user_id', $user->id)->count();
    }
}