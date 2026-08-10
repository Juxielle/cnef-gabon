<?php

namespace App\Http\Controllers;

use App\Models\Etude;
use Illuminate\Http\Request;

class EtudeController extends Controller
{
    public function index(Request $request)
    {
        $etudes = Etude::orderBy('ordre')->get();

        $selectedId = $request->query('etude');
        $etudeActive = $selectedId
            ? $etudes->firstWhere('id', (int) $selectedId)
            : $etudes->first();

        return view('pages.etudes', compact('etudes', 'etudeActive'));
    }
}
