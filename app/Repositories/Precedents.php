<?php

namespace App\Repositories;

use App\Precedent;
use App\User;

class Precedents extends Repository
{
	public $createRules;

    public function __construct()
    {
        $this->createRules = [
            'number' => 'required|min:5',
            'body' => 'required', 
            'court_id' => 'required', 
            'type_id' => 'required',
        ];
    }

    public function find($id)
    {
        return Precedent::findOrFail($id);
    }

    public function fetchAll()
    {
        return Precedent::all();
    }

    public function savedBy(User $user)
    {
        return $user->saves;
    }

    public function fetchMy()
    {
        return Precedent::loggedIn()->get();
    }

    public function create($data)
    {
        return Precedent::create($data);
    }

    public function save(Precedent $precedent, User $user)
    {
        $user->saves()->attach($precedent->id);
    }

    public function unsave(Precedent $precedent, User $user)
    {
        $user->saves()->detach($precedent->id);
    }

    public function delete(Precedent $precedent)
    {
        $precedent->delete();
    }
}
