<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acteur extends Model
{
    protected $fillable = [
        'categorie', 'nom', 'description', 'badge', 'icone_svg', 'ordre',
    ];
}
