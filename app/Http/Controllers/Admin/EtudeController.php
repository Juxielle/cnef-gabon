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
            ['name' => 'kpis', 'label' => 'Indicateurs clés', 'type' => 'repeater', 'required' => true, 'full' => true, 'add_label' => 'Ajouter un indicateur', 'columns' => [
                ['name' => 'v', 'label' => 'Valeur', 'placeholder' => 'Ex. 8,4 %'],
                ['name' => 'l', 'label' => 'Libellé', 'placeholder' => 'Ex. Croissance des actifs'],
            ]],
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
            'kpis' => ['required', 'array', 'min:1'],
            'kpis.*.v' => ['required', 'string', 'max:100'],
            'kpis.*.l' => ['required', 'string', 'max:150'],
        ];
    }
}
