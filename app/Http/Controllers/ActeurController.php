<?php

namespace App\Http\Controllers;

use App\Models\Acteur;
use Illuminate\Http\Request;

class ActeurController extends Controller
{
    public function index(Request $request)
    {
        $categorie = $request->query('categorie', 'tous');

        $tabs = [
            'tous' => 'Tous les acteurs',
            'bancaire' => 'Bancaire & Crédit',
            'paiement' => 'Paiement',
            'marches' => 'Marchés financiers',
            'assurance' => 'Assurance',
            'microfinance' => 'Microfinance',
            'economique' => 'Secteurs économiques',
        ];

        $acteurs = Acteur::when($categorie !== 'tous', fn ($q) => $q->where('categorie', $categorie))
            ->orderBy('ordre')
            ->get();

        return view('pages.acteurs', compact('acteurs', 'tabs', 'categorie'));
    }
}
