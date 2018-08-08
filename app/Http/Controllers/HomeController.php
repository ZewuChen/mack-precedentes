<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Precedent;
use App\Repositories\Precedents;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $precedents;

    public function __construct(Precedents $precedents)
    {
        $this->precedents = $precedents;
    }
    public function index()
    {
        $precedents = $this->precedents->fetchAll();

        return view('precedents.index', compact('precedents'));
    }
}
