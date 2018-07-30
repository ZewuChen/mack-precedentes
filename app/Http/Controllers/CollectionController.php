<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Precedent;
use App\Repositories\Collections;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    protected $collections;

    public function __construct(Collections $collections)
    {
        $this->collections = $collections;
    }

    public function show(Collection $collection)
    {
        $collections =  (new Collections)->fetchAll();
        return view('collections.show', compact('collection', 'collections'));
    }

    public function new(Request $request)
    {
        $insert = $this->collections->create([
                        'name' => $request->get('collection_name'),
                        'slug' => str_slug($request->get('collection_name') . '-' . str_random(10)),
                        'user_id' => Auth::user()->id
            ]);

        return redirect()->route('precedent.index');
    }

    public function store(Request $request)
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

        if($insert)
        {
            return redirect()->route('precedent.index');
        }
        else
        {
            return redirect()->route('precedent.index');
        }
    }

    public function destroy(Request $request)
    {
        $precedent = Precedent::find($request->get('precedent_id'));
        $delete = $precedent->collections()->detach($request->get('collection_id'));

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
