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
            ['name' => 'kpis', 'label' => 'Indicateurs clés (JSON)', 'type' => 'json', 'required' => true, 'full' => true, 'help' => 'Tableau de {"l":"libellé","v":"valeur","d":"delta"}'],
            ['name' => 'branches', 'label' => 'Branches / entités (JSON)', 'type' => 'json', 'required' => true, 'full' => true, 'help' => 'Tableau de {"n":"nom","pib":poids,"ev":evolution,"note":"Bon|Moy|Dif"}'],
            ['name' => 'chart_categories', 'label' => 'Étiquettes des graphiques (JSON)', 'type' => 'json', 'required' => true, 'full' => true, 'help' => 'Ex : ["2020","2021","2022","2023","2024"]'],
            ['name' => 'chart_dataset_1', 'label' => 'Données graphique 1 (JSON)', 'type' => 'json', 'required' => true, 'full' => true, 'help' => 'Ex : [1420,1380,1495,1620,1730]'],
            ['name' => 'chart_dataset_2', 'label' => 'Données graphique 2 (JSON)', 'type' => 'json', 'required' => true, 'full' => true, 'help' => 'Ex : [2100,2050,2280,2520,2890]'],
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
            'kpis' => ['required', 'json'],
            'branches' => ['required', 'json'],
            'chart_categories' => ['required', 'json'],
            'chart_dataset_1' => ['required', 'json'],
            'chart_dataset_2' => ['required', 'json'],
        ];
    }
}
