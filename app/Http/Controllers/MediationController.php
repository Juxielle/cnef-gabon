<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediateurCandidatureRequest;
use App\Http\Requests\StoreMediationRequestRequest;
use App\Models\MediateurCandidature;
use App\Models\MediationKpi;
use App\Models\MediationLitige;
use App\Models\MediationRequest as MediationRequestModel;
use App\Models\MediationSaisineTrimestre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MediationController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'saisine');

        $etablissements = [
            'Banques' => ['BGFI Bank Gabon', 'UGB — Union Gabonaise de Banque', 'BICIG', 'Ecobank Gabon', 'Orabank Gabon'],
            'Paiement & Mobile Money' => ['Airtel Money', 'Moov Money', 'PayCard Gabon'],
            'Assurance' => ['NSIA Gabon', 'AXA Gabon', 'OGAR'],
            'Microfinance' => ['FINIDEV', 'Autre IMF agréée'],
            'Autre' => ['Autre établissement agréé'],
        ];

        $naturesLitige = [
            'Contestation de frais ou commission',
            'Refus de crédit ou de service',
            'Problème de remboursement de crédit',
            'Clôture ou blocage de compte',
            'Transaction non autorisée / fraude',
            'Sinistre assurance non réglé',
            'Problème de transfert ou virement',
            'Pratique commerciale abusive',
            'Autre',
        ];

        $branches = [
            ['num' => 1, 'titre' => 'Crédit, Microfinance & Paiement', 'supervision' => 'COBAC'],
            ['num' => 2, 'titre' => "Compagnies d'assurance", 'supervision' => 'CIMA'],
            ['num' => 3, 'titre' => 'Intermédiaires de marché', 'supervision' => 'COSUMAF'],
        ];

        $mediationKpis = MediationKpi::orderBy('ordre')->get();
        $litiges = MediationLitige::orderBy('ordre')->get();
        $saisinesTrimestrielles = MediationSaisineTrimestre::orderBy('ordre')->get();

        return view('pages.mediation', compact(
            'tab', 'etablissements', 'naturesLitige', 'branches',
            'mediationKpis', 'litiges', 'saisinesTrimestrielles'
        ));
    }

    public function storeSaisine(StoreMediationRequestRequest $request)
    {
        $data = $request->validated();

        $pieces = [];
        if ($request->hasFile('pieces')) {
            foreach ($request->file('pieces') as $file) {
                $pieces[] = $file->store('mediation/saisines', 'local');
            }
        }

        $reference = 'MED-' . now()->format('ymd') . '-' . Str::upper(Str::random(4));

        MediationRequestModel::create([
            'reference' => $reference,
            'prenom' => $data['prenom'],
            'nom' => $data['nom'],
            'email' => $data['email'],
            'telephone' => $data['telephone'] ?? null,
            'etablissement' => $data['etablissement'],
            'nature_litige' => $data['nature_litige'],
            'description' => $data['description'],
            'pieces_jointes' => $pieces,
            'statut' => 'nouveau',
        ]);

        return back()->with('success', "Saisine enregistrée, {$data['prenom']}. Référence : {$reference}. Vous serez contacté sous 5 jours ouvrés.");
    }

    public function storeCandidature(StoreMediateurCandidatureRequest $request)
    {
        $data = $request->validated();

        $pieces = [];
        if ($request->hasFile('pieces')) {
            foreach ($request->file('pieces') as $file) {
                $pieces[] = $file->store('mediation/candidatures', 'local');
            }
        }

        MediateurCandidature::create([
            'prenom' => $data['prenom'],
            'nom' => $data['nom'],
            'email' => $data['email'],
            'telephone' => $data['telephone'] ?? null,
            'branche' => $data['branche'],
            'lettre_motivation' => $data['lettre_motivation'] ?? null,
            'pieces_jointes' => $pieces,
            'statut' => 'recue',
        ]);

        return back()->with('success', "Candidature enregistrée, {$data['prenom']}. Le CNEF étudiera votre dossier lors du prochain appel à candidature.");
    }
}
