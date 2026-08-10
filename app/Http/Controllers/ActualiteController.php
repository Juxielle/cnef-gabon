<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\VeilleInnovation;
use Illuminate\Http\Request;

class ActualiteController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'cnef');

        $categorieCnef = $request->query('categorie', 'tous');
        $cnefFiltres = [
            'tous' => 'Toutes catégories',
            'reglementation' => 'Réglementation',
            'communique' => 'Communiqués',
            'etude' => 'Études & Rapports',
            'evenement' => 'Événements',
        ];
        $actualites = Actualite::when($categorieCnef !== 'tous', fn ($q) => $q->where('categorie', $categorieCnef))
            ->orderBy('ordre')
            ->get();

        $categorieVeille = $request->query('veille_categorie', 'tous');
        $veilleFiltres = [
            'tous' => 'Tout',
            'fintech' => 'Fintech',
            'monetaire' => 'Pol. monétaire',
            'numerique' => 'Éco. numérique',
            'verte' => 'Finance verte',
            'ia' => 'IA & Finance',
            'crypto' => 'CBDC & Crypto',
        ];
        $veilleItems = VeilleInnovation::when($categorieVeille !== 'tous', fn ($q) => $q->where('categorie', $categorieVeille))
            ->orderBy('ordre')
            ->get();

        return view('pages.actualites', compact(
            'tab', 'actualites', 'cnefFiltres', 'categorieCnef',
            'veilleItems', 'veilleFiltres', 'categorieVeille'
        ));
    }
}
