<?php

namespace App\Policies;

use App\User;
use App\Collection;
use Illuminate\Auth\Access\HandlesAuthorization;

class CollectionPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Collection $collection)
    {
        return $user->id == $collection->user_id
            || $collection->isPublic();
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Collection $collection)
    {
        return true;
    }

    public function add(User $user, Collection $collection, Precedent $precedent)
    {
        return true;
    }

    public function delete(User $user, Collection $collection)
    {
        return true;
    }
}
