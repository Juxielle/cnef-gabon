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
            ['image' => 'image1.jpeg', 'alt' => "Événement communautaire de fin d'année organisé par la BEAC", 'tag' => 'Engagement citoyen — BEAC'],
            ['image' => 'image2.jpeg', 'alt' => 'Cérémonie institutionnelle de la COBAC', 'tag' => 'Coopération régionale — COBAC'],
            ['image' => 'image3.jpeg', 'alt' => 'Siège de la Banque des États de l\'Afrique Centrale (BEAC)', 'tag' => 'Siège de la BEAC'],
            ['image' => 'image4.jpeg', 'alt' => 'Vie institutionnelle de la COBAC', 'tag' => 'Vie institutionnelle — COBAC'],
            ['image' => 'image5.jpeg', 'alt' => 'Vue de Libreville, République Gabonaise', 'tag' => 'Libreville — République Gabonaise'],
        ];

        return view('pages.home', compact('stats', 'slides'));
    }
}
