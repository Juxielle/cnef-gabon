<?php

namespace App\Http\Controllers\Admin;

use App\Models\Acteur;
use App\Rules\SafeSvg;
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
            ['name' => 'icone_svg', 'label' => 'Icône', 'type' => 'svg_picker', 'required' => true, 'full' => true, 'mode' => 'fragment', 'options' => config('svg_library.icons'), 'help' => 'Choisissez une icône dans la galerie ou importez un fichier SVG.'],
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
            'icone_svg' => ['required', 'string', new SafeSvg],
        ];
    }
}
