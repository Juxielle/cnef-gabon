<?php

namespace App\Http\Controllers;

use App\Models\LienUtile;

class LienUtileController extends Controller
{
    public function index()
    {
        $groupes = LienUtile::orderBy('ordre')->get()->groupBy('groupe');

        return view('pages.liens', compact('groupes'));
    }
}
