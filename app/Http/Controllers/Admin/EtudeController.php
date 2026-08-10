<?php

namespace App\Http\Controllers\Admin;

use App\Models\Etude;
use Illuminate\Database\Eloquent\Model;

class EtudeController extends CrudController
{
    protected string $model = Etude::class;

    protected string $title = 'Études et publications';

    protected string $routeBase = 'admin.etudes';

    protected array $columns = [
        'titre' => 'Titre',
        'categorie' => 'Catégorie',
        'date_publication' => 'Date',
        'nombre_pages' => 'Pages',
    ];

    protected function fields(?Model $item = null): array
    {
        return [
            ['name' => 'categorie', 'label' => 'Catégorie', 'type' => 'text', 'required' => true, 'help' => 'Ex : Rapport annuel, Note de conjoncture...'],
            ['name' => 'date_publication', 'label' => 'Date de publication', 'type' => 'text', 'required' => true],
            ['name' => 'nombre_pages', 'label' => 'Nombre de pages', 'type' => 'number'],
            ['name' => 'fichier', 'label' => 'Nom du fichier (public/assets/documents)', 'type' => 'text'],
            ['name' => 'ordre', 'label' => "Ordre d'affichage", 'type' => 'number'],
            ['name' => 'titre', 'label' => 'Titre', 'type' => 'text', 'required' => true, 'full' => true],
            ['name' => 'description', 'label' => 'Description', 'type' => 'textarea', 'required' => true, 'full' => true],
            ['name' => 'kpis', 'label' => 'Indicateurs clés (JSON)', 'type' => 'json', 'required' => true, 'full' => true, 'help' => 'Tableau de {"v": "valeur", "l": "libellé"}. Ex : [{"v":"8,4%","l":"Croissance actifs"}]'],
        ];
    }

    protected function rules(?Model $item = null): array
    {
        return [
            'categorie' => ['required', 'string', 'max:100'],
            'date_publication' => ['required', 'string', 'max:100'],
            'nombre_pages' => ['nullable', 'integer'],
            'fichier' => ['nullable', 'string', 'max:255'],
            'ordre' => ['nullable', 'integer'],
            'titre' => ['required', 'string'],
            'description' => ['required', 'string'],
            'kpis' => ['required', 'json'],
        ];
    }
}
