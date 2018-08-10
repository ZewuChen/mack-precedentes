<?php

namespace App\Http\Controllers;

use App\User;
use App\Precedent;
use App\Collection;
use App\Repositories\Precedents;
use App\Repositories\Collections;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SavesController extends Controller
{
    protected $precedents;
    protected $collections;

    public function __construct(Precedents $precedents, Collections $collections)
    {
        $this->precedents = $precedents;
        $this->collections = $collections;
    }

    public function index()
    {
        $precedents = $this->precedents->fetchSaves();
        $collections =  $this->collections->fetchAll();

        return view('precedents.index', compact('precedents', 'collections'));
    }

    public function myPrecedents()
    {
        $precedents = $this->precedents->fetchMy();
        $collections =  $this->collections->fetchAll();

        return view('precedents.index', compact('precedents', 'collections'));
    }

    public function save(Precedent $precedent)
    {
        // authorize
        
        $this->precedents->save($precedent, Auth::user());

        return back()
            ->with('success', 'Precedente salvo.');
    }

    public function unsave(Precedent $precedent)
    {
        // authorize
        
        $this->precedents->unsave($precedent, Auth::user());

        return back()
            ->with('success', 'Precedente removido dos salvos.');
    }
}
