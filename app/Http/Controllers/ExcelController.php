<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Court;
use App\Precedent;
use App\PrecedentType;
use App\Tag;
use App\User;
use App\Repositories\Branchs;
use App\Repositories\Courts;
use App\Repositories\Precedents;
use App\Repositories\PrecedentsTypes;
use App\Repositories\Tags;
use Illuminate\Http\Request;
use Cyberduck\LaravelExcel\ImporterFacade;

class ExcelController extends Controller
{
    protected $branchs;
    protected $courts;
    protected $precedents;
    protected $precedentsTypes;
    protected $tags;

    public function __construct(Branchs $branchs, Courts $courts, Precedents $precedents, PrecedentsTypes $precedentsTypes, Tags $tags)
    {
        $this->branchs = $branchs;
        $this->courts = $courts;
        $this->precedents = $precedents;
        $this->precedentsTypes = $precedentsTypes;
        $this->tags = $tags;
    }

    public function index()
    {
    	return view('excel.index');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move('excel/', $fileName);

        $excel = ImporterFacade::make('Excel');
        $excel->load('excel/'. $fileName);

        $dados = $excel->getCollection();

        if ($fileName == "ramos") {
            $this->ramo($dados);
        }
        else if ($fileName == "tribunais") {
            $this->tribunal($dados);
        }
        else if ($fileName == "tipos") {
            $this->tipo($dados);
        }
        else{
            $this->precedent($dados); 
        }               

    }

    public function precedent($dados)
    {
        foreach ($dados as $row) 
        {
            $precedent = Precedent::where('body', $row[1])->first();
            $court = Court::where('name', $row[0])->first();
            $type = PrecedentType::where('name', $row[4])->first();
            $branch = Branch::where('name', $row[6])->first();

            switch ($row) 
            {
                case $row[2] == '': $row[2] = null;
                case $row[3] == '': $row[3] = null;
                //case $row[5] == '': $row[5] = str_random(5);
                case $row[8] == '': $row[8] = null;
                case $row[10] == '': $row[10] = null;
                case $row[9] == '': $row[9] = null;
                case $row[11] == '': $row[11] = null;
                case $row[12] == '': $row[12] = null;
            }

            if (isset($precedent)) 
            {
                if(isset($row[1]) && $row[1] != '')
                {
                    $precedent->update([
                        'number' => $row[5],
                        'body' => $row[1],
                        'segregated_at' => $row[2],
                        'approved_at' => $row[3],
                        'suspended_at' => $row[8],
                        'canceled_at' => $row[10],
                        'reviewed_at' => $row[9],
                        'pending_resources' => $row[11],
                        'additional_info' => $row[12],
                        'court_id' => $court['id'],
                        'user_id' => 1,
                        'type_id' => $type['id'],
                        'branch_id' => $branch['id']
                    ]);
                }
            }
            else
            {
                if(isset($row[1]) && $row[1] != '')
                {
                    $a = $this->precedents->create([
                        'number' => $row[5],
                        'body' => $row[1],
                        'slug' => str_slug($row[5] . '-' . str_random(10)),
                        'segregated_at' => $row[2],
                        'approved_at' => $row[3],
                        'suspended_at' => $row[8],
                        'canceled_at' => $row[10],
                        'reviewed_at' => $row[9],
                        'pending_resources' => $row[11],
                        'additional_info' => $row[12],
                        'court_id' => $court['id'],
                        'user_id' => 1,
                        'type_id' => $type['id'],
                        'branch_id' => $branch['id']
                    ]);
                }
            }

            #Tags
            /*if(isset($row[7]) && $row[7] != '')
            {
                $tags = $row[7];
                $tags = explode(";", $tags);

                foreach ($tags as $tag) {
                    # code...
                }
            }*/

        } 
    }

    public function tribunal($dados)
    {
        foreach ($dados as $row) 
        {
            $court = Court::where('alias', $row[0])->first();

            if (isset($court)) 
            {
                if(isset($row[1]) && $row[1] != '')
                {
                    $court->update([
                        'name' => $row[1]
                    ]);
                }
            }
            else
            {
                if(isset($row[1]) && $row[1] != '')
                {
                    $this->courts->create([
                        'name' => $row[1],
                        'alias' => $row[0]
                    ]);
                }
            }

        } 
    }

    public function tipo($dados)
    {
        foreach ($dados as $row) 
        {
            $tipo = PrecedentType::where('name', $row[0])->first();

            if (isset($tipo)) 
            {
                if($row[0] != '')
                {
                    $tipo->update([
                        'name' => $row[0]
                    ]);
                }
            }
            else
            {
                if($row[0] != '')
                {
                    $this->precedentsTypes->create([
                        'name' => $row[0]
                    ]);
                }
            }

        } 
    }

    public function ramo($dados)
    {
        foreach ($dados as $row) 
        {
            $ramo = Branch::where('name', $row[0])->first();

            if (isset($ramo)) 
            {
                if($row[0] != '')
                {
                    $ramo->update([
                        'name' => $row[0]
                    ]);
                }
            }
            else
            {
                if($row[0] != '')
                {
                    $this->branchs->create([
                        'name' => $row[0]
                    ]);
                }
            }

        } 
    }

}
