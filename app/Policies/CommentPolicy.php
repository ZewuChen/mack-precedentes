<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Comment $comment)
    {
        return $user->hasRole('admin')
            || $comment->isApproved();
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['admin', 'collaborator']);
    }

    public function approve(User $user, Comment $comment)
    {
        return $user->hasRole('admin')
            && ! $comment->isApproved();
    }

    public function delete(User $user, Comment $comment)
    {
        return $user->hasRole('admin');
    }
}
