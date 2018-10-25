<?php

namespace App\Repositories;

use App\Precedent;
use App\Tag;
use App\User;

class Precedents extends Repository
{
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

    public function create(array $data)
    {
        return Precedent::create([
            'number' => $data['number'],
            'body' => $data['body'],
            'segregated_at' => $data['segregated_at'],
            'approved_at' => $data['approved_at'],
            'suspended_at' => $data['suspended_at'],
            'canceled_at' => $data['canceled_at'],
            'reviewed_at' => $data['reviewed_at'],
            'pending_resources' => $data['pending_resources'],
            'additional_info' => $data['additional_info'],
            'court_id' => $data['court_id'],
            'user_id' => $data['user_id'],
            'type_id' => $data['type_id'],
            'branch_id' => $data['branch_id'],
        ]);
    }

    public function save(Precedent $precedent, User $user)
    {
        $user->saves()->attach($precedent->id);
    }

    public function unsave(Precedent $precedent, User $user)
    {
        $user->saves()->detach($precedent->id);
    }

    public function addTag(Precedent $precedent, Tag $tag)
    {
        $precedent->tags()->save($tag);

        return $precedent;
    }

    public function delete(Precedent $precedent)
    {
        $precedent->delete();
    }
}
