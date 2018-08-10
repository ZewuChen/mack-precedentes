<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function show(Branch $branch)
    {
        return view('branches.show', compact('branch'));
    }
}
