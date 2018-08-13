<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Http\Requests\CollectionAddPrecedentRequest;
use App\Http\Requests\CollectionCreateRequest;
use App\Precedent;
use App\Repositories\Collections;
use App\Repositories\Precedents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    protected $collections;

    public function __construct(Collections $collections)
    {
        $this->collections = $collections;
    }

    public function show(Collection $collection)
    {
        $this->authorize('view', $collection);

        return view('collections.show', compact('collection'));
    }

    public function add(CollectionAddPrecedentRequest $request, Collection $collection)
    {
        // authorize
        
        $precedent = (new Precedents)->find($request->get('precedent_id'));

        $this->collections->add($collection, $precedent);

        return back()
            ->with('success', 'Precedente adicionado à coleção ' . $collection->name . '.');
    }

    public function new(Request $request)
    {
        //Cria a nova coleção e já seta o ID da coleção no Request
        if($request->get('collection_name') != null)
        {
            $insert = $this->collections->create([
                'name' => $request->get('collection_name'),
                'slug' => str_slug($request->get('collection_name') . '-' . str_random(10)),
                'user_id' => Auth::user()->id
            ]);

            $request['collection_id'] = $insert['id'];
        }

        //Adiciona o precedente na coleção
        $precedent = Precedent::find($request->get('precedent_id'));
        $insert = $precedent->collections()->attach($request->get('collection_id'));

        return back();
        
    }

    public function store(CollectionCreateRequest $request)
    {
        // authorize
        
        $collection = $this->collections->create([
            'name' => $request->get('name'),
            'user_id' => Auth::user()->id,
        ]);

        return back()
            ->with('success', 'Coleção ' . $collection->name . ' criada.');
    }

    // public function destroy(Request $request)
    // {
    //     $precedent = $this->precedents->find($request->get('precedent_id'));
    //     $precedent->collections()->detach($request->get('collection_id'));

    //     return back();
    // }
    // 
    public function destroy(Collection $collection)
    {
        $this->authorize('delete', $collection);

        $this->collections->delete($collection);

        return redirect()
            ->route('home');
    }
}
