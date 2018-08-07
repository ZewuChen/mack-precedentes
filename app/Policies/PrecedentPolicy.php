<?php

namespace App\Policies;

use App\User;
use App\Precedent;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrecedentPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Precedent $precedent)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }
    
    public function update(User $user, Precedent $precedent)
    {
        return true;
    }

    public function delete(User $user, Precedent $precedent)
    {
        return $user->hasRole('admin');
    }
}
