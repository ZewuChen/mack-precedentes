<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Precedent;
use App\PrecedentType;
use App\Court;
use App\Collection;
use App\Repositories\Precedents;
use App\Repositories\PrecedentsTypes;
use App\Repositories\Courts;
use App\Repositories\Collections;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PrecedentController extends Controller
{
    protected $precedents;
    protected $precedentsTypes;
    protected $courts;
    protected $collections;

    public function __construct(Precedents $precedents, PrecedentsTypes $precedentsTypes, Courts $courts, Collections $collections)
    {
        $this->precedents = $precedents;
        $this->precedentsTypes = $precedentsTypes;
        $this->courts = $courts;
        $this->collections = $collections;
    }

    public function index()
    {
        $precedents = $this->precedents->fetchAll();
        $collections =  $this->collections->fetchAll();

        return view('precedents.index', compact('precedents', 'collections'));
    }

    public function show(Precedent $precedent)
    {
        return view('precedents.show', compact('precedent'));
    }

    public function create()
    {
        return view('precedents.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['user_id'] = Auth::user()->id;
        $data['slug'] = str_slug($data['number']) . '-' . str_random(10);
    
        $validate = validator($data, $this->precedents->createRules);

        if($validate->fails())
        {
            return redirect()->route('precedent.create')->withErrors($validate)->withInput(); 
        }
        else
        {
            $insert = $this->precedents->create($data);
            return redirect()->route('precedent.index');
        }
        
    }

    public function destroy($id)
    {
        $precedents = $this->$precedents->find($id);

        $delete = $precedents->delete();

        if($delete)
        {
            return redirect()->route('precedent.index');
        }
        else
        {
            return 'Falha ao excluir';
        }

    }

    public function search(Request $request)
    {
        $data = $request->except('_token');

        if(isset($data['data']))
        {
            $precedents = Precedent::search($data['data'])->Filter($data)->get();
        }
        else
        {
            $precedents = Precedent::Filter($data)->get();
        }
        
        $collections =  $this->collections->fetchAll();

        return view('precedents.index', compact('precedents', 'collections'));

    }

    public function like(Request $request)
    {
        $precedent = Precedent::find($request['precedent_id']);

        $precedent->likes()->create([
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('precedent.index');
    }

    public function deslike(Request $request)
    {
        $precedent = Precedent::find($request['precedent_id']);

        $precedent->likes()->where('user_id', Auth::user()->id)->delete();

        return redirect()->route('precedent.index');
    }

}
