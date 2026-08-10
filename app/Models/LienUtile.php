<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LienUtile extends Model
{
    protected $fillable = [
        'groupe', 'nom', 'pays', 'capitale', 'description',
        'url', 'statut', 'drapeau_svg', 'ordre',
    ];
}
