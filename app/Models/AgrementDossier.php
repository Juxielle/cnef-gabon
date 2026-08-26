<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgrementDossier extends Model
{
    protected $fillable = [
        'reference', 'raison_sociale', 'forme_juridique', 'numero_rccm', 'numero_nif',
        'type_agrement', 'nom_contact', 'email', 'telephone', 'description',
        'pieces_jointes', 'statut', 'commentaire_suivi',
    ];

    protected $casts = ['pieces_jointes' => 'array'];
}
