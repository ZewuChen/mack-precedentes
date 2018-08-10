<?php

namespace App\Repositories;

use App\Tag;

class Tags extends Repository
{
    public static function fetchAll()
    {
        return Tag::ordered()->get();
    }
}
