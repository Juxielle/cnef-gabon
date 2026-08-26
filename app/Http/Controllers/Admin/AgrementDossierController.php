<?php

namespace App\Http\Controllers\Admin;

use App\Models\AgrementDossier;
use Illuminate\Database\Eloquent\Model;

class AgrementDossierController extends SubmissionController
{
    protected string $model = AgrementDossier::class;
    protected string $title = "Dossiers d’agrément";
    protected string $routeBase = 'admin.agrement-dossiers';
    protected array $columns = ['reference' => 'Référence', 'raison_sociale' => 'Acteur', 'type_agrement' => "Type d’agrément", 'statut' => 'Statut', 'created_at' => 'Déposé le'];
    protected string $statusField = 'statut';
    protected array $statusOptions = [
        'soumis' => 'Dossier soumis', 'verification' => 'Vérification des pièces',
        'incomplet' => 'Complément requis', 'instruction' => 'En cours d’instruction',
        'avis_transmis' => 'Avis transmis', 'decision' => 'Décision disponible', 'rejete' => 'Dossier rejeté',
    ];

    protected function detailFields(Model $item): array
    {
        return [
            ['label' => 'Référence', 'value' => $item->reference], ['label' => 'Raison sociale', 'value' => $item->raison_sociale],
            ['label' => 'Forme juridique', 'value' => $item->forme_juridique ?: '—'], ['label' => 'RCCM', 'value' => $item->numero_rccm ?: '—'],
            ['label' => 'NIF', 'value' => $item->numero_nif ?: '—'], ['label' => "Type d’agrément", 'value' => $item->type_agrement],
            ['label' => 'Responsable', 'value' => $item->nom_contact], ['label' => 'Email', 'value' => $item->email],
            ['label' => 'Téléphone', 'value' => $item->telephone], ['label' => 'Présentation', 'value' => $item->description ?: '—', 'full' => true],
            ['label' => 'Pièces jointes', 'files' => $item->pieces_jointes ?? [], 'full' => true],
            ['label' => 'Déposé le', 'value' => $item->created_at->format('d/m/Y à H:i')],
        ];
    }
}
