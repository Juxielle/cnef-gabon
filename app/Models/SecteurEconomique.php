<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecteurEconomique extends Model
{
    protected $fillable = [
        'slug', 'titre', 'sante', 'kpis', 'branches',
        'chart_label_1', 'chart_label_2', 'chart_categories',
        'chart_dataset_1', 'chart_dataset_2', 'ordre',
    ];

    protected $casts = [
        'kpis' => 'array',
        'branches' => 'array',
        'chart_categories' => 'array',
        'chart_dataset_1' => 'array',
        'chart_dataset_2' => 'array',
    ];
}
