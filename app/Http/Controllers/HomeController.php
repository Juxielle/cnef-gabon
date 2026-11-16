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
            ['image' => 'image3.jpeg', 'alt' => 'Siège de la Banque des États de l\'Afrique Centrale (BEAC)', 'tag' => 'Siège de la BEAC'],
            ['image' => 'epargne-croissance.jpg', 'alt' => 'Jeunes pousses sur des piles de pièces symbolisant l’épargne et la croissance', 'tag' => 'Épargne et croissance économique'],
        ];

        $members = collect([
            'M. MINKO Thierry',
            'Mme MVONO Pierrette',
            'M. NGUEMA NGUEMA Sosthène',
            'M. SANA BANGUI Yvon',
            'M. ONDELE Marcel',
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
