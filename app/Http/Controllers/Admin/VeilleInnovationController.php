<?php

namespace App\Http\Controllers\Admin;

use App\Models\VeilleInnovation;
use Illuminate\Database\Eloquent\Model;

class VeilleInnovationController extends CrudController
{
    protected string $model = VeilleInnovation::class;

    protected string $title = 'Veille innovation mondiale';

    protected string $routeBase = 'admin.veille-innovations';

    protected array $columns = [
        'titre' => 'Titre',
        'categorie' => 'Catégorie',
        'impact' => 'Impact',
        'date_publication' => 'Date',
    ];

    protected function fields(?Model $item = null): array
    {
        return [
            ['name' => 'categorie', 'label' => 'Catégorie', 'type' => 'select', 'required' => true, 'options' => [
                'fintech' => 'Fintech',
                'monetaire' => 'Politique monétaire',
                'numerique' => 'Économie numérique',
                'verte' => 'Finance verte',
                'ia' => 'IA & Finance',
                'crypto' => 'CBDC & Crypto',
            ]],
            ['name' => 'impact', 'label' => 'Impact', 'type' => 'select', 'required' => true, 'options' => [
                'Élevé' => 'Élevé',
                'Moyen' => 'Moyen',
                'Faible' => 'Faible',
            ]],
            ['name' => 'source', 'label' => 'Source', 'type' => 'text', 'required' => true],
            ['name' => 'region', 'label' => 'Région', 'type' => 'text', 'required' => true],
            ['name' => 'date_publication', 'label' => 'Date de publication', 'type' => 'text', 'required' => true],
            ['name' => 'ordre', 'label' => "Ordre d'affichage", 'type' => 'number'],
            ['name' => 'titre', 'label' => 'Titre', 'type' => 'text', 'required' => true, 'full' => true],
            ['name' => 'resume', 'label' => 'Résumé', 'type' => 'textarea', 'required' => true, 'full' => true],
            ['name' => 'pertinence_afrique', 'label' => 'Pertinence Gabon / Afrique', 'type' => 'textarea', 'full' => true],
            ['name' => 'tags', 'label' => 'Tags', 'type' => 'list', 'full' => true, 'add_label' => 'Ajouter un tag', 'placeholder' => 'Ex. Fintech'],
        ];
    }

    protected function rules(?Model $item = null): array
    {
        return [
            'categorie' => ['required', 'string', 'max:50'],
            'impact' => ['required', 'string', 'max:20'],
            'source' => ['required', 'string', 'max:150'],
            'region' => ['required', 'string', 'max:100'],
            'date_publication' => ['required', 'string', 'max:100'],
            'ordre' => ['nullable', 'integer'],
            'titre' => ['required', 'string'],
            'resume' => ['required', 'string'],
            'pertinence_afrique' => ['nullable', 'string'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['nullable', 'string', 'max:50'],
        ];
    }
}
