<?php

namespace App\Repositories;

use App\Tag;

class Tags extends Repository
{
    public function create($data)
    {
    	return Tag::create($data);
    }
}
