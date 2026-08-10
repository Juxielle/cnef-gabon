<?php

namespace App\Http\Controllers;

use App\Models\TexteReglementaire;
use Illuminate\Http\Request;

class VeilleController extends Controller
{
    public function index(Request $request)
    {
        $currentCategorie = $request->query('categorie');

        $textes = TexteReglementaire::when($currentCategorie, fn ($q) => $q->where('categorie', $currentCategorie))
            ->orderBy('ordre')
            ->get();

        $totalTextes = TexteReglementaire::count();

        $labels = [
            'fondateurs' => 'Règlements CNEF',
            'mediation' => 'Décret & Arrêtés 2024-2025',
            'cobac' => 'Règlements COBAC',
            'cosumaf' => 'Marchés financiers',
            'cima' => 'Assurances — CIMA',
            'lbc' => 'LBC / FT',
            'teg' => 'TEG & Tarification',
        ];

        $groupMap = [
            'Textes fondateurs' => ['fondateurs'],
            'Médiation financière' => ['mediation'],
            'Réglementation CEMAC' => ['cobac', 'cosumaf', 'cima'],
            'Thèmes' => ['lbc', 'teg'],
        ];

        $counts = TexteReglementaire::selectRaw('categorie, count(*) as total')
            ->groupBy('categorie')
            ->pluck('total', 'categorie');

        $sidebarGroups = [];
        foreach ($groupMap as $groupLabel => $keys) {
            $sidebarGroups[$groupLabel] = array_map(fn ($key) => [
                'key' => $key,
                'label' => $labels[$key],
                'count' => $counts[$key] ?? 0,
            ], $keys);
        }

        return view('pages.veille', compact('textes', 'sidebarGroups', 'totalTextes', 'currentCategorie'));
    }
}
