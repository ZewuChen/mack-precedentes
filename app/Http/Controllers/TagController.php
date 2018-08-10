<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Repositories\Collections;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag)
    {    	
        return view('tags.show', compact('tag'));
    }
}
