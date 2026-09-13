<?php

namespace App\Http\Controllers\Admin;

use App\Models\LienUtile;
use App\Rules\SafeSvg;
use Illuminate\Database\Eloquent\Model;

class LienUtileController extends CrudController
{
    protected string $model = LienUtile::class;

    protected string $title = 'Liens utiles';

    protected string $routeBase = 'admin.liens';

    protected array $columns = [
        'nom' => 'Nom',
        'groupe' => 'Groupe',
        'statut' => 'Statut',
        'url' => 'URL',
    ];

    protected function fields(?Model $item = null): array
    {
        return [
            ['name' => 'groupe', 'label' => 'Groupe', 'type' => 'select', 'required' => true, 'options' => [
                'CNEF des autres pays de la CEMAC' => 'CNEF des autres pays de la CEMAC',
                'Régulateurs régionaux CEMAC' => 'Régulateurs régionaux CEMAC',
                'Institutions financières internationales' => 'Institutions financières internationales',
                'Banques centrales africaines et mondiales' => 'Banques centrales africaines et mondiales',
                'Organisations africaines et internationales' => 'Organisations africaines et internationales',
            ]],
            ['name' => 'nom', 'label' => 'Nom', 'type' => 'text', 'required' => true],
            ['name' => 'pays', 'label' => 'Pays (optionnel)', 'type' => 'text'],
            ['name' => 'capitale', 'label' => 'Capitale (optionnel)', 'type' => 'text'],
            ['name' => 'url', 'label' => 'URL', 'type' => 'text', 'required' => true],
            ['name' => 'statut', 'label' => 'Statut', 'type' => 'select', 'required' => true, 'options' => [
                'Actif' => 'Actif',
                'En déploiement' => 'En déploiement',
            ]],
            ['name' => 'ordre', 'label' => "Ordre d'affichage", 'type' => 'number'],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'required' => true, 'full' => true],
            ['name' => 'drapeau_svg', 'label' => 'Drapeau', 'type' => 'svg_picker', 'full' => true, 'mode' => 'svg', 'options' => config('svg_library.flags'), 'help' => 'Choisissez un drapeau ou importez un fichier SVG.'],
        ];
    }

    protected function rules(?Model $item = null): array
    {
        return [
            'groupe' => ['required', 'string', 'max:150'],
            'nom' => ['required', 'string', 'max:150'],
            'pays' => ['nullable', 'string', 'max:150'],
            'capitale' => ['nullable', 'string', 'max:100'],
            'url' => ['required', 'string', 'max:255'],
            'statut' => ['required', 'string', 'max:50'],
            'ordre' => ['nullable', 'integer'],
            'description' => ['required', 'string'],
            'drapeau_svg' => ['nullable', 'string', new SafeSvg],
        ];
    }
}
