<?php

namespace App\Http\Controllers;

use App\Court;
use App\Repositories\Collections;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function show(Court $court)
    {
        $collections =  (new Collections)->fetchAll();
    	
        return view('courts.show', compact('court', 'collections'));
    }
}
