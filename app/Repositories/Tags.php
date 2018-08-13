<?php

namespace App\Repositories;

use App\Tag;

class Tags extends Repository
{
    public static function fetchAll()
    {
        return Tag::ordered()->get();
    }

    public function create(array $data)
    {
        return Tag::firstOrNew([
            'name' => $data['name'],
            'slug' => str_slug($data['name']),
        ]);
    }
}
