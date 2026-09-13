<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $fillable = [
        'titre', 'message', 'niveau', 'url', 'label_lien',
        'starts_at', 'ends_at', 'published', 'ordre',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'published' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->where('published', true)
            ->where(fn (Builder $query) => $query->whereNull('starts_at')->orWhere('starts_at', '<=', now()))
            ->where(fn (Builder $query) => $query->whereNull('ends_at')->orWhere('ends_at', '>=', now()));
    }
}
