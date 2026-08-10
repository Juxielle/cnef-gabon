<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            ['v' => '9', 'l' => "Catégories d'acteurs réglementés"],
            ['v' => '120+', 'l' => 'Entités supervisées'],
            ['v' => '340+', 'l' => 'Dossiers de médiation'],
            ['v' => '35+', 'l' => 'Études économiques publiées'],
            ['v' => '18', 'l' => 'Provinces couvertes'],
        ];

        $slides = [
            ['image' => 'batiment1.png', 'alt' => 'Siège de la BEAC', 'tag' => 'Coopération régionale — BEAC'],
            ['image' => 'batiment3.jpg', 'alt' => 'Immeuble institutionnel de la zone CEMAC', 'tag' => 'Médiation financière'],
            ['image' => 'batiment4.jpg', 'alt' => "Tour vitrée d'une institution financière régionale", 'tag' => 'Inclusion financière'],
            ['image' => 'batiment5.jpg', 'alt' => "Bâtiment institutionnel à motif architectural africain", 'tag' => 'Éducation financière'],
            ['image' => 'batiment2.png', 'alt' => 'Siège de la COBAC, aux couleurs des États membres de la CEMAC', 'tag' => 'Coopération régionale — COBAC'],
        ];

        return view('pages.home', compact('stats', 'slides'));
    }
}
