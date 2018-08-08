<?php

namespace App\Http\Controllers;

use App\Repositories\Branchs;
use App\Repositories\Courts;
use App\Repositories\PrecedentsTypes;
use Illuminate\Http\Request;
use Cyberduck\LaravelExcel\ImporterFacade;

class ExcelController extends Controller
{
    protected $branchs;
    protected $courts;
    protected $precedentsTypes;

    public function __construct(Branchs $branchs, Courts $courts, PrecedentsTypes $precedentsTypes)
    {
        $this->branchs = $branchs;
        $this->courts = $courts;
        $this->precedentsTypes = $precedentsTypes;
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

        //$this->tribunal($dados);             //Insere os tribunais
        //$this->tipo($dados);                  //Insere os tipos
        //$this->ramo($dados);                  //Insere os ramos 

        

    }

    public function tribunal($dados)
    {
        foreach ($dados as $row) 
        {
            echo $row[0] . "<br>";

            $this->courts->create([
                'name' => $row[0],
                'alias' => $row[0]
            ]);

        } 
    }

    public function tipo($dados)
    {
        foreach ($dados as $row) 
        {
            echo $row[0] . "<br>";

            $this->precedentsTypes->create([
                'name' => $row[0],
                'alias' => $row[0]
            ]);

        } 
    }

    public function ramo($dados)
    {
        foreach ($dados as $row) 
        {
            echo $row[0] . "<br>";

            $this->branchs->create([
                'name' => $row[0]
            ]);

        } 
    }

}
