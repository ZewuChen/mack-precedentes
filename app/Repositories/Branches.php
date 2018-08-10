<?php

namespace App\Repositories;

use App\Branch;

class Branches extends Repository
{
    public static function fetchAll()
    {
        return Branch::ordered()->get();
    }
}