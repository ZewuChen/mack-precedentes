<?php

namespace App\Http\Controllers;

use App\Precedent;
use App\Collection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $precedents = Precedent::all();
        $collections = Collection::ordered()->get();

        return view('precedents.index', compact('precedents', 'collections'));
    }
}
