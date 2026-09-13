<?php

namespace App\Http\Controllers\Admin;

use App\Models\Annonce;
use Illuminate\Database\Eloquent\Model;

class AnnonceController extends CrudController
{
    protected string $model = Annonce::class;
    protected string $title = 'Annonces importantes';
    protected string $routeBase = 'admin.annonces';

    protected array $columns = [
        'titre' => 'Titre',
        'niveau' => 'Priorité',
        'starts_at' => 'Début',
        'ends_at' => 'Fin',
        'published' => 'Publiée',
    ];

    protected function fields(?Model $item = null): array
    {
        return [
            ['name' => 'titre', 'label' => 'Titre', 'type' => 'text', 'required' => true],
            ['name' => 'niveau', 'label' => 'Priorité', 'type' => 'select', 'required' => true, 'options' => [
                'information' => 'Information',
                'important' => 'Important',
                'urgent' => 'Urgent',
            ]],
            ['name' => 'message', 'label' => 'Message', 'type' => 'textarea', 'required' => true, 'full' => true],
            ['name' => 'starts_at', 'label' => 'Début de diffusion', 'type' => 'datetime-local', 'help' => 'Laissez vide pour publier immédiatement.'],
            ['name' => 'ends_at', 'label' => 'Fin de diffusion', 'type' => 'datetime-local', 'help' => 'Laissez vide pour une durée indéterminée.'],
            ['name' => 'url', 'label' => 'Lien (optionnel)', 'type' => 'url'],
            ['name' => 'label_lien', 'label' => 'Texte du lien', 'type' => 'text'],
            ['name' => 'ordre', 'label' => "Ordre d'affichage", 'type' => 'number'],
            ['name' => 'published', 'label' => 'Annonce publiée', 'type' => 'checkbox', 'full' => true],
        ];
    }

    protected function rules(?Model $item = null): array
    {
        return [
            'titre' => ['required', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:1000'],
            'niveau' => ['required', 'in:information,important,urgent'],
            'url' => ['nullable', 'url', 'max:500'],
            'label_lien' => ['nullable', 'string', 'max:80', 'required_with:url'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after:'.(request('starts_at') ?: 'now')],
            'published' => ['nullable', 'boolean'],
            'ordre' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
