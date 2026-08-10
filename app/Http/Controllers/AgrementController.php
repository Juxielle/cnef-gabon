<?php

namespace App\Http\Controllers;

class AgrementController extends Controller
{
    public function index()
    {
        $categories = [
            ['badge' => 'Établissements de crédit', 'titre' => 'Banques & Établissements financiers', 'description' => "Agrément COBAC avec instruction préalable du CNEF pour toute entité souhaitant exercer des opérations de banque au Gabon.", 'items' => ['Banques commerciales et universelles', 'Établissements financiers spécialisés', 'Sociétés de financement et de leasing', 'Bureaux de représentation étrangers']],
            ['badge' => 'Paiement & Monnaie électronique', 'titre' => 'Établissements de paiement', 'description' => "Autorisation préalable obligatoire pour toute activité d'émission de monnaie électronique ou de prestation de services de paiement.", 'items' => ['Opérateurs de mobile money', 'Émetteurs de monnaie électronique', 'Plateformes de paiement en ligne', 'Systèmes de transfert de fonds']],
            ['badge' => 'Marchés financiers', 'titre' => 'Sociétés de bourse & Gestion', 'description' => "Agrément COSUMAF avec avis du CNEF pour les intermédiaires opérant sur les marchés financiers de la CEMAC.", 'items' => ['Sociétés de bourse et courtage', 'Sociétés de gestion de portefeuille', 'Conseillers en investissement', 'Dépositaires centraux agréés']],
            ['badge' => 'Assurance & Réassurance', 'titre' => "Compagnies d'assurance", 'description' => "Agrément du Ministère des Finances avec avis technique du CNEF pour l'exercice des activités d'assurance sous le Code CIMA.", 'items' => ["Compagnies d'assurance vie", 'Assurances dommages et responsabilités', 'Sociétés de réassurance', "Courtiers et agents d'assurance"]],
            ['badge' => 'Microfinance', 'titre' => 'Institutions de microfinance', 'description' => "Agrément COBAC avec instruction du CNEF pour les IMF selon leur catégorie, garantissant la protection des épargnants.", 'items' => ["Coopératives d'épargne et de crédit (COOPEC)", 'Sociétés de microfinance cat. 1 & 2', 'Structures de financement rural', 'Plateformes de financement participatif']],
            ['badge' => 'Autres acteurs', 'titre' => 'Opérateurs économiques spéciaux', 'description' => "Le CNEF suit également les opérateurs de change, bureaux de représentation, entités soumises aux obligations LBC/FT.", 'items' => ['Bureaux de change et cambistes', 'Intermédiaires en opérations de banque', 'Entités soumises déclarations GAFI/GABAC', "Fonds d'investissement et capital-risque"]],
        ];

        $procedure = [
            'Constitution du dossier selon exigences réglementaires',
            'Dépôt au secrétariat du CNEF',
            'Instruction & analyse par les services',
            'Avis technique & transmission COBAC si requis',
            'Décision & notification au demandeur',
        ];

        return view('pages.agrements', compact('categories', 'procedure'));
    }
}
