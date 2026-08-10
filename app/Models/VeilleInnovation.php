<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VeilleInnovation extends Model
{
    protected $fillable = [
        'categorie', 'titre', 'resume', 'impact', 'source', 'region',
        'date_publication', 'pertinence_afrique', 'tags', 'ordre',
    ];

    protected $casts = [
        'tags' => 'array',
    ];
}
