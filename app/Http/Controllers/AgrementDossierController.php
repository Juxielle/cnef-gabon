<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgrementDossierRequest;
use App\Models\AgrementDossier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AgrementDossierController extends Controller
{
    public function index(): View
    {
        return view('pages.agrement-suivi', ['dossier' => null]);
    }

    public function store(StoreAgrementDossierRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $pieces = [];
        foreach ($request->file('pieces', []) as $file) {
            $pieces[] = $file->store('agrements/dossiers', 'local');
        }

        do {
            $reference = 'AGR-'.now()->format('Ymd').'-'.strtoupper(Str::random(6));
        } while (AgrementDossier::where('reference', $reference)->exists());

        AgrementDossier::create([
            ...collect($data)->except('pieces')->all(),
            'reference' => $reference,
            'pieces_jointes' => $pieces,
            'statut' => 'soumis',
        ]);

        return redirect()->route('agrement-dossiers.index')
            ->with('dossier_reference', $reference)
            ->with('success', 'Votre dossier a été transmis au CNEF. Conservez précieusement son numéro de suivi.');
    }

    public function track(Request $request): View
    {
        $data = $request->validate([
            'reference' => ['required', 'string', 'max:40', 'regex:/^AGR-[A-Z0-9-]+$/i'],
        ], ['reference.required' => 'Saisissez le numéro de votre dossier.', 'reference.regex' => 'Le format du numéro de dossier est invalide.']);

        $reference = strtoupper(trim($data['reference']));
        $dossier = AgrementDossier::where('reference', $reference)->first();

        return view('pages.agrement-suivi', compact('dossier', 'reference'));
    }
}
