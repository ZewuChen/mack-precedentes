<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Court;
use App\Http\Requests\PrecedentCreateRequest;
use App\Precedent;
use App\PrecedentType;
use App\Repositories\Courts;
use App\Repositories\Precedents;
use App\Repositories\Tags;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function store(PrecedentCreateRequest $request)
    {
        $this->authorize('create', Precedent::class);

        DB::beginTransaction();

        try {
            $data = array_add(
                $request->except('tags', '_token'),
                'user_id', Auth::user()->id
            );
            
            $precedent = $this->precedents->create($data);

            $tagNames = ($request->get('tags')) ? explode(',', $request->get('tags')) : array();

            foreach ($tagNames as $name) {
                $tag = (new Tags)->create(['name' => $name]);                
                $this->precedents->addTag($precedent, $tag);
            }

            DB::commit();

            return redirect()
                ->route('precedents.show', $precedent)
                ->with('success', 'Precedente ' . $precedent->number . ' criado com sucesso.');
        } catch (\Exception $e) {
            DB::rollback();

            return back();
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
