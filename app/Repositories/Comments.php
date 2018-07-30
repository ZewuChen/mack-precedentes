<?php

namespace App\Repositories;

use App\Comment;

class Comments extends Repository
{
	public $createRules;

	public function __construct()
	{
		$this->createRules = ['body' => 'required|nullable',
                              'file' => 'mimes:pdf'
        ];
	}

}
