<?php

namespace App\Repositories;

use App\Collection;
use App\Precedent;

class Collections extends Repository
{
    public function fetchAll()
    {
        return Collection::ordered()->get();
    }

    public function add(Collection $collection, Precedent $precedent)
    {
        $collection->precedents()->save($precedent);
    }

    public function create($data)
    {
        return Collection::create($data);
    }
}
