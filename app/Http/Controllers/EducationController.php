<?php

namespace App\Http\Controllers;

class EducationController extends Controller
{
    public function index()
    {
        $modules = [
            ['titre' => 'Budget personnel et familial', 'description' => "Planifier revenus et dépenses, constituer une épargne de précaution et atteindre ses objectifs financiers.", 'icone' => '<path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
            ['titre' => 'Services bancaires', 'description' => "Comprendre les produits et services des banques et IMF : compte, crédit, épargne, transferts.", 'icone' => '<path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>'],
            ['titre' => "Initiation à l'investissement", 'description' => "Formes d'investissement accessibles au Gabon : obligations, fonds communs, marchés COSUMAF.", 'icone' => '<path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>'],
            ['titre' => 'Financement des entreprises', 'description' => "Modes de financement pour les PME : crédit bancaire, microfinance, capital-risque, subventions.", 'icone' => '<path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>'],
            ['titre' => 'Prévention des arnaques', 'description' => "Identifier les pratiques frauduleuses, schémas de Ponzi et établissements non agréés.", 'icone' => '<path d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2v16z"/>'],
            ['titre' => 'Retraite et prévoyance', 'description' => "Préparer sa retraite et protéger sa famille grâce aux instruments de prévoyance disponibles.", 'icone' => '<path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'],
            ['titre' => 'Mobile money & fintech', 'description' => "Utiliser les services de paiement mobile en toute sécurité, comprendre les risques et les droits.", 'icone' => '<path d="M12 18h.01M8 21h8a2 2 0 002-2v-2H6v2a2 2 0 002 2zm0-18h8a2 2 0 012 2v2H6V5a2 2 0 012-2zm-2 8h12M6 11h12"/>'],
            ['titre' => 'Inclusion financière rurale', 'description' => "Accéder aux services financiers formels en dehors des centres urbains — IMF, coopératives, Poste.", 'icone' => '<path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>'],
        ];

        return view('pages.education', compact('modules'));
    }
}
