<?php

namespace App\Http\Controllers;

use App\Models\Annonce;

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

        $members = collect([
            'M. MINKO Thierry',
            'Mme MVONO Pierrette',
            'M. NGUEMA NGUEMA Sosthène',
            'M. SANA BANGUI Yvon',
            'M. ONDEL Marcel',
            'M. MAPANGOU Guy Bertrand',
            'M. MANGUE AYINGONO Salvatore',
            'M. BANGA NTOLO Louis',
            'M. OTOLI Christian Rodrigue',
            'M. ABOUNA Luther',
            'M. NGOLO ALINI Jean Baptiste',
            "M. ONDO METO'O Symolin",
            'M. KOUAKOUA Claude Alain',
            'M. BIKALOU Jean Baptiste',
            'M. PAMBOU Serge Maurice',
            'M. ASSOUMOU ELLA Giscard',
            'M. NDJEBI Dimitri Kevin',
            'M. NTOKO Pierre Marie',
            'M. GAMBIGHA Ulrich',
            'M. MOUSSIROU Stephen',
            'M. OBIANG OBIANG Jean Robert',
            'Mme BARRO Aïssatou',
            "M. EBANG ABA'A Rudy",
            'M. NZDENGUE MBOMBA Gildas',
            'M. BISSIELOU Rodrigue',
        ])->map(fn (string $name, int $index) => [
                'name' => $name,
                'image' => 'members/member-'.($index + 1).'.png',
                'alt' => $name,
            ]);

        $annonces = Annonce::active()
            ->orderBy('ordre')
            ->orderByDesc('starts_at')
            ->get();

        return view('pages.home', compact('stats', 'slides', 'members', 'annonces'));
    }
}
