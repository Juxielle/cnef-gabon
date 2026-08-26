<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function respond(Request $request): JsonResponse
    {
        $data = $request->validate(['message' => ['required', 'string', 'max:800']]);
        $ascii = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $data['message']);
        $message = strtolower($ascii === false ? $data['message'] : $ascii);

        $intents = [
            [['mediation', 'litige', 'plainte', 'reclamation', 'fraude', 'compte bloque'], "La médiation financière du CNEF est un dispositif gratuit destiné à faciliter le règlement des litiges avec un établissement financier. Vous pouvez déposer une saisine en ligne et joindre jusqu’à 5 pièces justificatives. Une référence de suivi vous sera communiquée.", 'Déposer une saisine', route('mediation.index')],
            [['agrement', 'autorisation', 'licence', 'creer une banque', 'etablissement financier'], "Le CNEF instruit les dossiers d’agrément et transmet son avis à l’autorité compétente selon l’activité : COBAC, COSUMAF ou Ministère des Finances. La rubrique Agréments présente les catégories concernées et les étapes de la procédure.", 'Consulter les agréments', route('agrements.index')],
            [['reglement', 'loi', 'texte', 'cobac', 'cemac', 'cosumaf', 'cima', 'lbc', 'teg'], "La veille réglementaire rassemble les principaux textes applicables au secteur financier gabonais : règlements CNEF et COBAC, marchés financiers, assurances, LBC/FT et tarification.", 'Voir les textes', route('veille.index')],
            [['barometre', 'indicateur', 'economie', 'economique', 'statistique', 'secteur', 'pib'], "Le baromètre économique présente les indicateurs du Gabon et une lecture par secteur d’activité. Vous pouvez y consulter les KPI, tendances et données sectorielles disponibles.", 'Ouvrir le baromètre', route('barometre.index')],
            [['etude', 'rapport', 'publication', 'document', 'analyse'], "Les études, rapports et notes d’analyse du CNEF sont regroupés dans la rubrique Études et publications.", 'Voir les publications', route('etudes.index')],
            [['education', 'budget', 'epargne', 'credit', 'arnaque', 'mobile money', 'fintech'], "L’espace Éducation financière propose des ressources sur le budget, l’épargne, le crédit, l’investissement, la prévention des arnaques et l’usage sécurisé du mobile money.", 'Découvrir les ressources', route('education.index')],
            [['acteur', 'banque', 'assurance', 'microfinance', 'paiement', 'supervise'], "Le CNEF suit plusieurs catégories d’acteurs financiers : établissements de crédit, services de paiement, assurances, microfinance et intermédiaires de marché. La liste est consultable par catégorie.", 'Voir les acteurs', route('acteurs.index')],
            [['contact', 'telephone', 'email', 'adresse', 'horaire', 'ouvert', 'localisation'], "Le Secrétariat Général du CNEF est situé à la Direction Nationale de la BEAC, Boulevard Triomphal à Libreville. Il est joignable au +241 11 72 20 00 ou à contact@cnef.ga, du lundi au vendredi de 7h30 à 16h30.", 'Accéder au formulaire', route('home').'#contact'],
            [['actualite', 'nouvelle', 'innovation', 'ia', 'crypto', 'cbdc', 'finance verte'], "La rubrique Actualités réunit les communications du CNEF et une veille sur les innovations financières : fintech, politique monétaire, IA, finance verte et actifs numériques.", 'Voir les actualités', route('actualites.index')],
        ];

        foreach ($intents as [$terms, $answer, $label, $url]) {
            if (collect($terms)->contains(fn (string $term) => str_contains($message, $term))) {
                return response()->json(compact('answer') + ['action' => compact('label', 'url')]);
            }
        }

        return response()->json([
            'answer' => "Je n’ai pas identifié précisément votre demande. Je peux vous orienter sur la médiation, les agréments, la réglementation, les acteurs financiers, le baromètre économique, les publications ou les coordonnées du CNEF. Pour une réponse officielle à un cas particulier, utilisez le formulaire de contact.",
            'action' => ['label' => 'Contacter le CNEF', 'url' => route('home').'#contact'],
        ]);
    }
}
