<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaroKpi extends Model
{
    protected $fillable = [
        'secteur', 'valeur', 'unite', 'libelle', 'delta', 'tendance', 'ordre',
    ];
}
