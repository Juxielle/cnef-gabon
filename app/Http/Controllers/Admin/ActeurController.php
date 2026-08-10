<?php

namespace App\Http\Controllers\Admin;

use App\Models\Acteur;
use Illuminate\Database\Eloquent\Model;

class ActeurController extends CrudController
{
    protected string $model = Acteur::class;

    protected string $title = 'Acteurs réglementés';

    protected string $routeBase = 'admin.acteurs';

    protected array $columns = [
        'nom' => 'Nom',
        'categorie' => 'Catégorie',
        'badge' => 'Badge',
        'ordre' => 'Ordre',
    ];

    protected function fields(?Model $item = null): array
    {
        return [
            ['name' => 'nom', 'label' => 'Nom', 'type' => 'text', 'required' => true],
            ['name' => 'categorie', 'label' => 'Catégorie', 'type' => 'select', 'required' => true, 'options' => [
                'bancaire' => 'Bancaire & Crédit',
                'paiement' => 'Paiement',
                'marches' => 'Marchés financiers',
                'assurance' => 'Assurance',
                'microfinance' => 'Microfinance',
                'economique' => 'Secteurs économiques',
            ]],
            ['name' => 'badge', 'label' => 'Badge (ex: Agrément COBAC)', 'type' => 'text', 'required' => true],
            ['name' => 'ordre', 'label' => "Ordre d'affichage", 'type' => 'number'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'required' => true, 'full' => true],
            ['name' => 'icone_svg', 'label' => 'Icône (balise SVG <path>)', 'type' => 'textarea', 'required' => true, 'full' => true, 'help' => 'Exemple : <path d="M3 21h18M3 10h18"/>'],
        ];
    }

    protected function rules(?Model $item = null): array
    {
        return [
            'nom' => ['required', 'string', 'max:255'],
            'categorie' => ['required', 'string', 'max:50'],
            'badge' => ['required', 'string', 'max:100'],
            'ordre' => ['nullable', 'integer'],
            'description' => ['required', 'string'],
            'icone_svg' => ['required', 'string'],
        ];
    }
}
