<?php

namespace App\Http\Controllers\Admin;

use App\Models\SecteurEconomique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class SecteurEconomiqueController extends CrudController
{
    protected string $model = SecteurEconomique::class;

    protected string $title = 'Secteurs économiques (baromètre)';

    protected string $routeBase = 'admin.secteurs';

    protected array $columns = [
        'titre' => 'Titre',
        'slug' => 'Slug',
        'sante' => 'Santé',
        'ordre' => 'Ordre',
    ];

    protected function fields(?Model $item = null): array
    {
        return [
            ['name' => 'slug', 'label' => 'Identifiant (slug)', 'type' => 'text', 'required' => true, 'help' => 'Unique, sans espace. Ex : bancaire'],
            ['name' => 'titre', 'label' => 'Titre du secteur', 'type' => 'text', 'required' => true],
            ['name' => 'sante', 'label' => 'Santé du secteur', 'type' => 'select', 'required' => true, 'options' => [
                'bon' => 'Bon (vert)',
                'moy' => 'Moyen (jaune)',
                'dif' => 'Difficile (rouge)',
            ]],
            ['name' => 'ordre', 'label' => "Ordre d'affichage", 'type' => 'number'],
            ['name' => 'chart_label_1', 'label' => 'Libellé graphique 1', 'type' => 'text', 'required' => true],
            ['name' => 'chart_label_2', 'label' => 'Libellé graphique 2', 'type' => 'text', 'required' => true],
            ['name' => 'kpis', 'label' => 'Indicateurs clés', 'type' => 'repeater', 'required' => true, 'full' => true, 'add_label' => 'Ajouter un indicateur', 'columns' => [
                ['name' => 'l', 'label' => 'Libellé'], ['name' => 'v', 'label' => 'Valeur'], ['name' => 'd', 'label' => 'Évolution / delta'],
            ]],
            ['name' => 'branches', 'label' => 'Branches / entités', 'type' => 'repeater', 'required' => true, 'full' => true, 'add_label' => 'Ajouter une branche', 'columns' => [
                ['name' => 'n', 'label' => 'Nom'], ['name' => 'pib', 'label' => 'Poids', 'type' => 'number', 'step' => 'any'], ['name' => 'ev', 'label' => 'Évolution', 'type' => 'number', 'step' => 'any'],
                ['name' => 'note', 'label' => 'État', 'type' => 'select', 'options' => ['Bon' => 'Bon', 'Moy' => 'Moyen', 'Dif' => 'Difficile']],
            ]],
            ['name' => 'chart_categories', 'label' => 'Étiquettes des graphiques', 'type' => 'list', 'required' => true, 'full' => true, 'add_label' => 'Ajouter une période', 'placeholder' => 'Ex. 2024'],
            ['name' => 'chart_dataset_1', 'label' => 'Données du graphique 1', 'type' => 'list', 'input_type' => 'number', 'step' => 'any', 'required' => true, 'full' => true, 'add_label' => 'Ajouter une valeur'],
            ['name' => 'chart_dataset_2', 'label' => 'Données du graphique 2', 'type' => 'list', 'input_type' => 'number', 'step' => 'any', 'required' => true, 'full' => true, 'add_label' => 'Ajouter une valeur'],
        ];
    }

    protected function rules(?Model $item = null): array
    {
        return [
            'slug' => ['required', 'string', 'max:50', 'alpha_dash', Rule::unique('secteur_economiques', 'slug')->ignore($item?->id)],
            'titre' => ['required', 'string', 'max:150'],
            'sante' => ['required', 'string', 'max:10'],
            'ordre' => ['nullable', 'integer'],
            'chart_label_1' => ['required', 'string', 'max:100'],
            'chart_label_2' => ['required', 'string', 'max:100'],
            'kpis' => ['required', 'array', 'min:1'],
            'kpis.*.l' => ['required', 'string', 'max:150'],
            'kpis.*.v' => ['required', 'string', 'max:100'],
            'kpis.*.d' => ['nullable', 'string', 'max:100'],
            'branches' => ['required', 'array', 'min:1'],
            'branches.*.n' => ['required', 'string', 'max:150'],
            'branches.*.pib' => ['required', 'numeric'],
            'branches.*.ev' => ['required', 'numeric'],
            'branches.*.note' => ['required', 'in:Bon,Moy,Dif'],
            'chart_categories' => ['required', 'array', 'min:1'],
            'chart_categories.*' => ['required', 'string', 'max:50'],
            'chart_dataset_1' => ['required', 'array', 'min:1'],
            'chart_dataset_1.*' => ['required', 'numeric'],
            'chart_dataset_2' => ['required', 'array', 'min:1'],
            'chart_dataset_2.*' => ['required', 'numeric'],
        ];
    }
}
