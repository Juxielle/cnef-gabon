<?php

namespace App\Http\Controllers;

use App\Models\BaroKpi;
use App\Models\SecteurEconomique;
use Illuminate\Http\Request;

class BarometreController extends Controller
{
    public function index(Request $request)
    {
        $baroKpis = BaroKpi::orderBy('ordre')->get();

        $secteurs = SecteurEconomique::orderBy('ordre')->get();

        $slug = $request->query('secteur', 'macro');
        $secteurActif = $secteurs->firstWhere('slug', $slug) ?? $secteurs->first();

        return view('pages.barometre', compact('baroKpis', 'secteurs', 'secteurActif'));
    }
}
