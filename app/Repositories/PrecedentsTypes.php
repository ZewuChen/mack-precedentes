<?php

namespace App\Repositories;

use App\PrecedentType;

class PrecedentsTypes extends Repository
{
    public static function fetchAll()
    {
        return PrecedentType::ordered()->get();
    }

    public function create($data)
    {
    	return PrecedentType::create($data);
    }

}
