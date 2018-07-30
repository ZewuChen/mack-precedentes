<?php

namespace App\Repositories;

use App\Precedent;

class Precedents extends Repository
{
	public $createRules;

	public function __construct()
	{
		$this->createRules = ['number' => 'required|min:5',
                              'body' => 'required',
                              'court_id' => 'required',
                              'type_id' => 'required'
        ];
	}

    public function fetchAll()
    {
        return Precedent::all();
    }

    public function fetchSaves()
    {
        return auth()->user()->saves;
    }

    public function fetchMy()
    {
        return Precedent::loggedIn()->get();
    }

    public function create($data)
    {
    	return Precedent::create($data);
    }
}
