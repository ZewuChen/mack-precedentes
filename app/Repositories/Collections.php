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

    public function remove(Collection $collection, Precedent $precedent)
    {
        $collection->precedents()->detach($precedent->id);
    }

    public function create($data)
    {
        return Collection::create([
            'name' => $data['name'],
            'user_id' => $data['user_id'],
        ]);
    }

    public function delete(Collection $collection)
    {
        $collection->delete();
    }
}
