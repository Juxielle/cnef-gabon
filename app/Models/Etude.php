<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etude extends Model
{
    protected $fillable = [
        'categorie', 'titre', 'description', 'kpis',
        'date_publication', 'nombre_pages', 'fichier', 'ordre',
    ];

    protected $casts = [
        'kpis' => 'array',
    ];
}
