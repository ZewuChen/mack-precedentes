<?php

namespace App\Repositories;

use App\Collection;

class Collections extends Repository
{
    public function fetchAll()
    {
        return Collection::ordered()->get();
    }

    public function create($data)
    {
    	return Collection::create($data);
    }

}
