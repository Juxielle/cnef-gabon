<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acteur;
use App\Models\Actualite;
use App\Models\AgrementDossier;
use App\Models\Annonce;
use App\Models\ContactMessage;
use App\Models\Etude;
use App\Models\LienUtile;
use App\Models\SecteurEconomique;
use App\Models\TexteReglementaire;
use App\Models\VeilleInnovation;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            ['label' => 'Acteurs réglementés', 'value' => Acteur::count(), 'route' => 'admin.acteurs.index'],
            ['label' => 'Dossiers d’agrément', 'value' => AgrementDossier::count(), 'route' => 'admin.agrement-dossiers.index'],
            ['label' => 'Textes réglementaires', 'value' => TexteReglementaire::count(), 'route' => 'admin.textes.index'],
            ['label' => 'Études publiées', 'value' => Etude::count(), 'route' => 'admin.etudes.index'],
            ['label' => 'Secteurs baromètre', 'value' => SecteurEconomique::count(), 'route' => 'admin.secteurs.index'],
            ['label' => 'Actualités CNEF', 'value' => Actualite::count(), 'route' => 'admin.actualites.index'],
            ['label' => 'Veille innovation', 'value' => VeilleInnovation::count(), 'route' => 'admin.veille-innovations.index'],
            ['label' => 'Annonces officielles', 'value' => Annonce::count(), 'route' => 'admin.annonces.index'],
            ['label' => 'Liens utiles', 'value' => LienUtile::count(), 'route' => 'admin.liens.index'],
        ];

        $pending = [
            ['label' => 'Messages de contact non traités', 'value' => ContactMessage::where('traite', false)->count(), 'route' => 'admin.messages.index'],
            ['label' => 'Dossiers d’agrément en instruction', 'value' => AgrementDossier::where('statut', 'en_cours')->count(), 'route' => 'admin.agrement-dossiers.index'],
        ];

        return view('admin.dashboard', compact('stats', 'pending'));
    }
}
