<?php

namespace App\Http\Controllers\Admin;

use App\Models\MediationRequest;
use Illuminate\Database\Eloquent\Model;

class MediationRequestController extends SubmissionController
{
    protected string $model = MediationRequest::class;

    protected string $title = 'Saisines de médiation';

    protected string $routeBase = 'admin.mediation-requests';

    protected array $columns = [
        'reference' => 'Référence',
        'prenom' => 'Prénom',
        'nom' => 'Nom',
        'etablissement' => 'Établissement',
        'statut' => 'Statut',
        'created_at' => 'Reçu le',
    ];

    protected string $statusField = 'statut';

    protected array $statusOptions = [
        'nouveau' => 'Nouveau',
        'en_cours' => 'En cours',
        'resolu' => 'Résolu',
        'rejete' => 'Rejeté',
    ];

    protected function detailFields(Model $item): array
    {
        return [
            ['label' => 'Référence', 'value' => $item->reference],
            ['label' => 'Prénom', 'value' => $item->prenom],
            ['label' => 'Nom', 'value' => $item->nom],
            ['label' => 'Email', 'value' => $item->email],
            ['label' => 'Téléphone', 'value' => $item->telephone ?: '—'],
            ['label' => 'Établissement concerné', 'value' => $item->etablissement],
            ['label' => 'Nature du litige', 'value' => $item->nature_litige],
            ['label' => 'Description', 'value' => $item->description, 'full' => true],
            ['label' => 'Pièces jointes', 'files' => $item->pieces_jointes ?? [], 'full' => true],
            ['label' => 'Reçu le', 'value' => $item->created_at->format('d/m/Y à H:i')],
        ];
    }
}
