<?php

namespace App\Repositories;

use App\Comment;
use App\User;

class Comments extends Repository
{
    public function create(User $user, array $data)
    {
        return Comment::create([
            'body' => $data['body'],
            'precedent_id' => $data['precedent_id'],
            'user_id' => $user->id,
        ]);
    }

    public function setFilePath(Comment $comment, $path)
    {
        $comment->update([
            'file' => $path,
        ]);

        $comment->save();

        return $comment;
    }

    public function approve(Comment $comment)
    {
        $comment->update([
            'is_approved' => '1',
        ]);

        $comment->save();

        return $comment;
    }

    public function delete(Comment $comment)
    {
        return $comment->delete();
    }
}
