<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MediationController extends Controller
{
    /**
     * Présentation de la Médiation Financière en République Gabonaise
     * et orientation vers le Portail Numérique autonome dédié.
     */
    public function index(Request $request): View
    {
        $mediationPortalUrl = config('app.mediation_portal_url', 'http://cnef-mediation.test');

        $branches = [
            [
                'numero' => 'Branche 1',
                'titre' => 'Établissements de Crédit, EMF & Paiement',
                'description' => 'Banques commerciales, établissements de crédit, microfinances agréées COBAC et opérateurs de monnaie électronique (Mobile Money).',
                'badge' => 'Banques • EMF • Mobile Money',
                'exemples' => ['BGFI Bank', 'BICIG', 'UGB', 'Finam', 'Airtel Money', 'Moov Money'],
            ],
            [
                'numero' => 'Branche 2',
                'titre' => 'Compagnies d’Assurance',
                'description' => 'Sociétés d’assurance vie et non-vie régies par le Code CIMA opérant en République Gabonaise.',
                'badge' => 'Assurances CIMA',
                'exemples' => ['OGAR', 'Sanlam', 'AXA Gabon', 'Sunu Assurances', 'NSIA'],
            ],
            [
                'numero' => 'Branche 3',
                'titre' => 'Intermédiaires de Marché',
                'description' => 'Sociétés de bourse, sociétés de gestion d’actifs (Asset Management) et intermédiaires agréés par la COSUMAF.',
                'badge' => 'Marchés Financiers COSUMAF',
                'exemples' => ['BGFIBourse', 'Financia Asset Management', 'Africa Bright', 'ESS Bourse'],
            ],
        ];

        $piliers = [
            [
                'titre' => 'Recours 100% Gratuit',
                'description' => 'Aucun frais d’instruction, de dossier ou de conseil ne peut être imputé au réclamant particulier.',
                'icone' => 'shield',
            ],
            [
                'titre' => 'Indépendance & Équité',
                'description' => 'Le Médiateur Financier statue en toute neutralité, sans subordination aux établissements bancaires ou financiers.',
                'icone' => 'scale',
            ],
            [
                'titre' => 'Confidentialité Absolue',
                'description' => 'Toutes les déclarations, pièces et négociations menées au cours de la médiation sont strictement confidentielles.',
                'icone' => 'lock',
            ],
            [
                'titre' => 'Délai d’Instruction Rapide',
                'description' => 'Recevabilité examinée sous 5 jours ouvrés et proposition de solution amiable sous 90 jours maximum.',
                'icone' => 'clock',
            ],
        ];

        return view('pages.mediation', compact('mediationPortalUrl', 'branches', 'piliers'));
    }
}
