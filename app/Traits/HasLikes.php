<?php

namespace App\Traits;

use App\Like;

trait HasLikes
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'like');
    }
}