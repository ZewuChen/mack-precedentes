<?php

namespace App\Http\Controllers;

use App\User;
use App\Repositories\Collections;
use App\Repositories\Users;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	protected $user;

	public function __contruct(Users $user)
    {
        $this->user = $user;
    }

    public function index()
    {
    	$collections =  (new Collections)->fetchAll();
    	$user = auth()->user()->find(Auth::user()->id);
    	
    	return view('user.show', compact('user', 'collections'));
    }

    public function update(Request $request)
    {    	
    	$data = $request->all();

    	$createRules = ['name' => 'required',
					    'email' =>'required',
						'description' =>'nullable',
                        'photo' => 'mimes:jpeg,jpg,bmp,png|nullable'
        ];

    	$validate = validator($data, $createRules);

        if ($validate->fails())
        {
            return redirect()->back()->withErrors($validate);
        }
        else
        {
            $user = User::find(Auth::user()->id);
            $photo = !isset($data['photo']) ? null : Storage::disk('local')->putFile('photos', $data['photo']); 

            $user->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'description' => $data['description'],
                    'photo' => $photo
                ]);        

	        return redirect()->route('user.index');
	    }
    }

    public function password(Request $request)
    {
        $data = $request->all();
        $user = User::find(Auth::user()->id);

        $createRules = ['new_password' => 'min:6'];

        $validate = validator($data, $createRules);

        if( $validate->fails())
        {
            return redirect()->route('user.index')->withErrors($validate);
        }
        else
        {
            if (isset($data['old_password']))
            {
                if (Hash::check($data['old_password'], $user->password))
                {
                    $user->update([
                            'password' => Hash::make($data['new_password'])
                    ]);

                    return redirect()->route('user.index');
                }  
                else
                {
                    return redirect()->back()->withErrors('Senha Inválida');
                } 
            }
            else
            {
                $user->update([
                            'password' => Hash::make($data['new_password'])
                    ]);

                    return redirect()->route('user.index');
            }
        }
        
    }

}
