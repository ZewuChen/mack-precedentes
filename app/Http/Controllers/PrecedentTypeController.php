<?php

namespace App\Http\Controllers;

use App\PrecedentType;
use App\Repositories\Collections;
use Illuminate\Http\Request;

class PrecedentTypeController extends Controller
{
    public function show(PrecedentType $precedentType)
    {
    	$collections =  (new Collections)->fetchAll();
    	
        return view('types.show', compact('precedentType', 'collections'));
    }
}
