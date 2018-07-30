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

    public function store(Request $request)
    {

        $precedent = Precedent::find($request->get('precedent_id'));
        $insert = $precedent->saves()->attach(Auth::user()->id);

        if($insert)
        {
            return redirect()->back();
        }
        else
        {
            return redirect()->route('precedent.index');
        }
    }

    public function destroy(Request $request)
    {
        $precedent = Precedent::find($request->get('precedent_id'));
        $delete = $precedent->saves()->detach(Auth::user()->id);

        if($delete)
        {
            return redirect()->back();
        }
        else
        {
            return 'Erro';
        }
    }
}
