<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;

class Users extends Repository
{
    public function update(User $user, array $data)
    {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'description' => $data['description'],
        ]);

        return $user;
    }

    public function setPhotoPath(User $user, $photoPath)
    {
        $user->update([
            'photo' => $photoPath,
        ]);

        return $user;
    }

    public function setPassword(User $user, $password)
    {
        $user->update([
            'password' => Hash::make($password),
        ]);

        return $user;
    }
}
