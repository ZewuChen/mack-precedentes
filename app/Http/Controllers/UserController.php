<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPasswordUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\Users;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function profile()
    {
        $user = Auth::user();

        return view('user.profile', compact('user'));
    }

    public function update(UserUpdateRequest $request)
    {
        $user = Auth::user();

        $this->users->update(
            $user,
            $request->only('name', 'email', 'description')
        );

        if ($request->has('photo')) {
            $path = Storage::putFile('users', $request->file('photo'));

            $this->users->setPhotoPath($user, $path);
        }        

        return back()
            ->with('success', 'Perfil atualizado.');
    }

    public function updatePassword(UserPasswordUpdateRequest $request)
    {
        $user = Auth::user();

        if ($request->get('old_password')) {
            if (! Hash::check($request->get('old_password'), $user->password)) {
                return back()
                    ->with('success', 'A senha digitada é inválida.');
            }
        }

        $this->users->setPassword($user, $request->get('password'));

        return back()
            ->with('success', 'Senha atualizada com sucesso.');
    }
}
