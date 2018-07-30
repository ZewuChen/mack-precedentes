<?php

namespace App\Repositories;

use App\User;

class Users extends Repository
{
	public $createRules;

	public function __construct()
	{
		$this->createRules = ['name' => 'required',
							  'email' =>'required',
							  'description' =>'nullable',
                              'file' => 'mimes:jpeg,bmp,png'
        ];
	}
}
