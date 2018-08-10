<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Precedent;
use App\PrecedentType;
use App\Court;
use App\Collection;
use App\Repositories\Precedents;
use App\Repositories\Courts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PrecedentController extends Controller
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
            return redirect()->route('precedents.create')->withErrors($validate)->withInput(); 
        }
        else
        {
            $insert = $this->precedents->create($data);
            return redirect()->route('precedents.show', $insert);
        }
        
    }

    public function destroy(Precedent $precedent)
    {
        $this->authorize('delete', $precedent);

        $this->precedents->delete($precedent);

        return back()
            ->with('success', 'Precedente removido.');
    }

    public function search(Request $request)
    {
        $data = $request->all();

        if ($request->get('data')) {
            $precedents = Precedent::search($data['data'])->filter($data)->get();
        } else {
            $precedents = Precedent::filter($data)->get();
        }

        return view('precedents.index', compact('precedents'));
    }

    public function saved()
    {
        // authorize
        
        $precedents = $this->precedents->savedBy(Auth::user());

        return view('precedents.saved', compact('precedents'));
    }

    public function like(Precedent $precedent)
    {
        $precedent->likes()->create([
            'user_id' => Auth::user()->id
        ]);

        return back()
            ->with('success', 'Precedente ' . $precedent->number . ' curtido.');
    }

    public function dislike(Precedent $precedent)
    {
        $precedent->likes()->where('user_id', Auth::user()->id)->delete();

        return back()
            ->with('success', 'Precedente ' . $precedent->number . ' descurtido.');
    }
}
