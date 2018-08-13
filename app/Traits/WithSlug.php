<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait WithSlug
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public static function boot()
    {
        static::creating(function ($model) {
            $model->slug = Uuid::uuid4();
        });
    }
}