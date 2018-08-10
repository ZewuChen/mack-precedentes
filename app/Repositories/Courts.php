<?php

namespace App\Repositories;

use App\Court;

class Courts extends Repository
{
    public static function fetchAll()
    {
        return Court::ordered()->get();
    }
}
