<?php

namespace App\Http\Controllers\Admin;

use App\Models\BaroKpi;
use Illuminate\Database\Eloquent\Model;

class BaroKpiController extends CrudController
{
    protected string $model = BaroKpi::class;

    protected string $title = 'Indicateurs clés du baromètre';

    protected string $routeBase = 'admin.baro-kpis';

    protected array $columns = [
        'secteur' => 'Secteur',
        'valeur' => 'Valeur',
        'unite' => 'Unité',
        'tendance' => 'Tendance',
    ];

    protected function fields(?Model $item = null): array
    {
        return [
            ['name' => 'secteur', 'label' => 'Secteur (court)', 'type' => 'text', 'required' => true, 'help' => 'Ex : PIB, Inflation, Bancaire...'],
            ['name' => 'valeur', 'label' => 'Valeur', 'type' => 'text', 'required' => true],
            ['name' => 'unite', 'label' => 'Unité', 'type' => 'text', 'required' => true, 'help' => 'Ex : %, Mds FCFA'],
            ['name' => 'tendance', 'label' => 'Tendance', 'type' => 'select', 'required' => true, 'options' => [
                'up' => 'Hausse (vert)',
                'dn' => 'Baisse (rouge)',
                'neu' => 'Neutre',
            ]],
            ['name' => 'ordre', 'label' => "Ordre d'affichage", 'type' => 'number'],
            ['name' => 'libelle', 'label' => 'Libellé complet', 'type' => 'text', 'required' => true, 'full' => true],
            ['name' => 'delta', 'label' => 'Variation affichée', 'type' => 'text', 'required' => true, 'full' => true, 'help' => 'Ex : +2,8% ou ▲ +2,8% ou ↑ norme 8%'],
        ];
    }

    protected function rules(?Model $item = null): array
    {
        return [
            'secteur' => ['required', 'string', 'max:100'],
            'valeur' => ['required', 'string', 'max:50'],
            'unite' => ['required', 'string', 'max:30'],
            'tendance' => ['required', 'string', 'max:10'],
            'ordre' => ['nullable', 'integer'],
            'libelle' => ['required', 'string', 'max:150'],
            'delta' => ['required', 'string', 'max:50'],
        ];
    }
}
