<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function team()
    {
        return view('pages.team');
    }

    public function definition()
    {
        return view('pages.definition');
    }

    public function patreon()
    {
        return view('pages.patreon');
    }

    public function proposal()
    {
        return view('pages.proposal');
    }

    public function scientificMethodology()
    {
        return view('pages.scientific-methodology');
    }

    public function collectionMethodology()
    {
        return view('pages.collection-methodology');
    }
}
