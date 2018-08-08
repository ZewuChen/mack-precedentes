<?php

namespace App\Repositories;

use App\Branch;

class Branchs extends Repository
{
    public function create($data)
    {
    	return Branch::create($data);
    }
}
