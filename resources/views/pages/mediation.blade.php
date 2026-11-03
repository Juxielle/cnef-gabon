@extends('layouts.app')

@section('title', 'Médiation financière')
@php($breadcrumb = 'Médiation financière')

@section('content')

{{-- ── EN-TÊTE DE PRÉSENTATION INSTITUTIONNELLE (THÈME CNEF) ── --}}
<section class="sec" style="background:var(--vert-f);padding-top:48px;padding-bottom:44px">
  <div class="stag light rv">Dispositif Public Officiel</div>
  <h1 class="sh light rv" style="margin-bottom:14px">La Médiation Financière</h1>
  <p class="si light rv" style="max-width:780px;margin-bottom:0">
    Institué par le <strong>Décret N° 0121/PR/MEP du 21 mars 2024</strong> sous l'égide du CNEF, le Mécanisme de Médiation Financière offre à tout usager un recours <strong>gratuit, neutre et confidentiel</strong> pour régler à l'amiable ses différends avec les banques, microfinances, assurances et opérateurs de paiement en République Gabonaise.
  </p>
</section>

{{-- ── CONTENU DE PRÉSENTATION DU DISPOSITIF ── --}}
<section class="sec" style="background:var(--blanc);padding-top:48px;padding-bottom:52px">
  <div style="max-width:1100px;margin:0 auto">

    {{-- 1. Les 4 Garanties Fondamentales --}}
    <div style="margin-bottom:40px">
      <div class="stag">Garanties Fondamentales</div>
      <h2 class="sh" style="font-size:clamp(22px,2.8vw,32px);margin-bottom:8px">Pourquoi recourir au Médiateur Financier ?</h2>
      <p class="si" style="margin-bottom:24px;max-width:680px">
        Un cadre de protection institutionnel conçu pour rétablir le dialogue entre consommateurs et professionnels du secteur financier.
      </p>

      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:18px">
        @foreach ($piliers as $pilier)
          <div style="background:#fff;border:1px solid var(--brd);border-radius:var(--rl);padding:22px;box-shadow:0 2px 8px rgba(0,0,0,.03);display:flex;flex-direction:column;gap:10px">
            <div style="width:38px;height:38px;border-radius:8px;background:var(--vert-c);color:var(--vert);display:flex;align-items:center;justify-content:center">
              @if ($pilier['icone'] === 'shield')
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
              @elseif ($pilier['icone'] === 'scale')
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 3v18M5 7l-3 6a3 3 0 006 0zM19 7l-3 6a3 3 0 006 0zM5 7h14"/></svg>
              @elseif ($pilier['icone'] === 'lock')
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
              @else
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
              @endif
            </div>
            <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;font-weight:600;margin:0;color:var(--txt)">
              {{ $pilier['titre'] }}
            </h3>
            <p style="font-size:13px;color:var(--txt2);line-height:1.55;margin:0">
              {{ $pilier['description'] }}
            </p>
          </div>
        @endforeach
      </div>
    </div>

    {{-- 2. Les 3 Branches Assujetties --}}
    <div style="margin-bottom:40px">
      <div class="stag">Périmètre d'Intervention</div>
      <h2 class="sh" style="font-size:clamp(22px,2.8vw,32px);margin-bottom:8px">Les 3 Branches d'Établissements Assujettis</h2>
      <p class="si" style="margin-bottom:24px;max-width:680px">
        Tous les établissements ayant formellement adhéré au dispositif en République Gabonaise sont soumis à la procédure de médiation amiable.
      </p>

      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:18px">
        @foreach ($branches as $b)
          <div style="background:var(--gris);border:1px solid var(--brd);border-radius:var(--rl);padding:22px;display:flex;flex-direction:column;justify-content:space-between">
            <div>
              <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px">
                <span style="font-size:11.5px;font-weight:700;color:var(--or-d);background:var(--or-p);padding:3px 8px;border-radius:4px">
                  {{ $b['numero'] }}
                </span>
                <span style="font-size:11px;color:var(--txt3);font-weight:500">
                  {{ $b['badge'] }}
                </span>
              </div>
              <h3 style="font-family:'Space Grotesk',sans-serif;font-size:16px;font-weight:600;margin:0 0 8px 0;color:var(--txt)">
                {{ $b['titre'] }}
              </h3>
              <p style="font-size:13px;color:var(--txt2);line-height:1.55;margin:0 0 14px 0">
                {{ $b['description'] }}
              </p>
            </div>
            <div style="border-top:1px dashed var(--gris-m);padding-top:10px">
              <span style="font-size:11px;color:var(--txt3);display:block;margin-bottom:6px">Acteurs majeurs adhérents :</span>
              <div style="display:flex;flex-wrap:wrap;gap:5px">
                @foreach ($b['exemples'] as $ex)
                  <span style="font-size:11px;background:#fff;border:1px solid var(--brd);padding:2px 7px;border-radius:4px;color:var(--txt2)">
                    {{ $ex }}
                  </span>
                @endforeach
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    {{-- 3. Procédure de Saisine --}}
    <div style="margin-bottom:24px">
      <div class="stag">Procédure &amp; Démarches</div>
      <h2 class="sh" style="font-size:clamp(22px,2.8vw,32px);margin-bottom:8px">Comment se déroule la Médiation ?</h2>
      <p class="si" style="margin-bottom:20px;max-width:680px">
        Une démarche amiable, rapide et encadrée en trois étapes clés.
      </p>

      <div style="display:grid;grid-template-columns:1fr;gap:14px">
        <div style="display:flex;gap:16px;align-items:flex-start;background:var(--gris);padding:18px 20px;border-radius:var(--r);border-left:3px solid var(--vert)">
          <div style="width:32px;height:32px;border-radius:50%;background:var(--vert);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;flex-shrink:0">1</div>
          <div>
            <h4 style="font-size:15px;font-weight:600;margin:0 0 4px 0;color:var(--txt)">Étape 1 : Réclamation écrite préalable</h4>
            <p style="font-size:13px;color:var(--txt2);margin:0;line-height:1.55">
              Vous devez avoir adressé au préalable une réclamation écrite à votre établissement. En cas de rejet ou d'absence de réponse sous <strong>45 jours</strong> (30 jours pour certains services de paiement), la saisine du Médiateur est officiellement ouverte.
            </p>
          </div>
        </div>

        <div style="display:flex;gap:16px;align-items:flex-start;background:var(--gris);padding:18px 20px;border-radius:var(--r);border-left:3px solid var(--or)">
          <div style="width:32px;height:32px;border-radius:50%;background:var(--or);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;flex-shrink:0">2</div>
          <div>
            <h4 style="font-size:15px;font-weight:600;margin:0 0 4px 0;color:var(--txt)">Étape 2 : Dépôt du dossier en ligne sur le portail dédié</h4>
            <p style="font-size:13px;color:var(--txt2);margin:0;line-height:1.55">
              Remplissez le formulaire en ligne sur le portail de la médiation financière et joignez vos pièces justificatives. Un <strong>code confidentiel de suivi (format MF-YYYY-XXXXXX)</strong> vous est automatiquement attribué.
            </p>
          </div>
        </div>

        <div style="display:flex;gap:16px;align-items:flex-start;background:var(--gris);padding:18px 20px;border-radius:var(--r);border-left:3px solid var(--vert)">
          <div style="width:32px;height:32px;border-radius:50%;background:var(--vert);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;flex-shrink:0">3</div>
          <div>
            <h4 style="font-size:15px;font-weight:600;margin:0 0 4px 0;color:var(--txt)">Étape 3 : Instruction &amp; Solution amiable</h4>
            <p style="font-size:13px;color:var(--txt2);margin:0;line-height:1.55">
              Le Secrétariat examine la recevabilité sous <strong>5 jours ouvrés</strong>. Le Médiateur instruit le dossier et propose un accord amiable sous <strong>90 jours</strong> maximum. La signature de l'accord clôt définitivement le litige.
            </p>
          </div>
        </div>
      </div>
    </div>

    {{-- BOUTON VERS LE SITE DE LA MÉDIATION (EN BAS, ESPACEMENT MAÎTRISÉ) --}}
    <div style="text-align:center;margin-top:24px">
      <a href="{{ $mediationPortalUrl }}" target="_blank" rel="noopener" class="btn-or" style="font-size:14.5px;padding:13px 28px;box-shadow:0 4px 14px rgba(232,163,23,.25)">
        <span>Accéder au Portail Dédié de la Médiation</span>
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6M15 3h6v6M10 14L21 3"/></svg>
      </a>
      <div style="margin-top:8px;font-size:12px;color:var(--txt3)">
        Portail officiel dédié : saisine en ligne, suivi de dossier sécurisé &amp; annuaire des adhérents
      </div>
    </div>

  </div>
</section>

@endsection
