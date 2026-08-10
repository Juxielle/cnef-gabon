<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediationRequest extends Model
{
    protected $fillable = [
        'reference', 'prenom', 'nom', 'email', 'telephone', 'etablissement',
        'nature_litige', 'description', 'pieces_jointes', 'statut',
    ];

    protected $casts = [
        'pieces_jointes' => 'array',
    ];
}
