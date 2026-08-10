@extends('layouts.app')

@section('title', 'Médiation financière')
@php($breadcrumb = 'Médiation financière')

@section('content')
<section class="sec" style="background:var(--vert-f);padding-top:48px;padding-bottom:50px">
  <div class="stag light">Service aux citoyens</div>
  <h2 class="sh light">Médiation financière</h2>
  <p class="si light">Un service gratuit de résolution amiable des litiges individuels entre consommateurs et établissements financiers assujettis, organisé par le CNEF sous la supervision de la COBAC, de la CIMA et de la COSUMAF.</p>
  <div style="display:flex;gap:12px;flex-wrap:wrap">
    <div style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);border-radius:8px;padding:12px 18px">
      <div style="font-size:10.5px;color:rgba(255,255,255,.45);text-transform:uppercase;letter-spacing:.1em;margin-bottom:4px">Base juridique</div>
      <div style="font-size:13px;font-weight:400;color:rgba(255,255,255,.8)">Décret N° 0121/PR/MEP du 21 mars 2024</div>
    </div>
    <div style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);border-radius:8px;padding:12px 18px">
      <div style="font-size:10.5px;color:rgba(255,255,255,.45);text-transform:uppercase;letter-spacing:.1em;margin-bottom:4px">Modalités — procédure</div>
      <div style="font-size:13px;font-weight:400;color:rgba(255,255,255,.8)">Arrêté N° 001.25 MEP du 07 janvier 2025</div>
    </div>
    <div style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);border-radius:8px;padding:12px 18px">
      <div style="font-size:10.5px;color:rgba(255,255,255,.45);text-transform:uppercase;letter-spacing:.1em;margin-bottom:4px">Désignation des médiateurs</div>
      <div style="font-size:13px;font-weight:400;color:rgba(255,255,255,.8)">Arrêté N° 002.25 MEP du 07 janvier 2025</div>
    </div>
  </div>
</section>

<section class="sec" style="padding-top:36px">
  <div class="med-tabs">
    <a class="mtab {{ $tab === 'saisine' ? 'on' : '' }}" href="{{ route('mediation.index', ['tab' => 'saisine']) }}">Formulaire de saisine</a>
    <a class="mtab {{ $tab === 'procedure' ? 'on' : '' }}" href="{{ route('mediation.index', ['tab' => 'procedure']) }}">Procédure &amp; 3 branches</a>
    <a class="mtab {{ $tab === 'stats' ? 'on' : '' }}" href="{{ route('mediation.index', ['tab' => 'stats']) }}">Statistiques des litiges</a>
    <a class="mtab {{ $tab === 'candidature' ? 'on' : '' }}" href="{{ route('mediation.index', ['tab' => 'candidature']) }}">Candidature médiateur</a>
  </div>

  {{-- ============ SAISINE ============ --}}
  @if ($tab === 'saisine')
  <div class="mtab-panel on">
    <div class="med-layout">
      <div class="med-form-wrap">
        <h3 class="mf-title">Saisir le médiateur financier</h3>
        <p class="mf-sub">Gratuit · Traitement sous 5 jours ouvrés · Confidentiel</p>

        <form method="POST" action="{{ route('mediation.saisine.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="frow">
            <div class="fg">
              <label class="fl">Prénom</label>
              <input type="text" class="fi" name="prenom" value="{{ old('prenom') }}" placeholder="Jean-Baptiste">
              @error('prenom') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="fg">
              <label class="fl">Nom</label>
              <input type="text" class="fi" name="nom" value="{{ old('nom') }}" placeholder="Ndong Essone">
              @error('nom') <div class="form-error">{{ $message }}</div> @enderror
            </div>
          </div>
          <div class="fg">
            <label class="fl">Email</label>
            <input type="email" class="fi" name="email" value="{{ old('email') }}" placeholder="votre@email.com">
            @error('email') <div class="form-error">{{ $message }}</div> @enderror
          </div>
          <div class="fg">
            <label class="fl">Téléphone</label>
            <input type="tel" class="fi" name="telephone" value="{{ old('telephone') }}" placeholder="+241 06 00 00 00">
          </div>
          <div class="fg">
            <label class="fl">Établissement concerné</label>
            <select class="fsel" name="etablissement">
              <option value="">— Sélectionnez —</option>
              @foreach ($etablissements as $groupe => $items)
                <optgroup label="{{ $groupe }}">
                  @foreach ($items as $item)
                    <option @selected(old('etablissement') === $item)>{{ $item }}</option>
                  @endforeach
                </optgroup>
              @endforeach
            </select>
            @error('etablissement') <div class="form-error">{{ $message }}</div> @enderror
          </div>
          <div class="fg">
            <label class="fl">Nature du litige</label>
            <select class="fsel" name="nature_litige">
              <option value="">— Type de litige —</option>
              @foreach ($naturesLitige as $nature)
                <option @selected(old('nature_litige') === $nature)>{{ $nature }}</option>
              @endforeach
            </select>
            @error('nature_litige') <div class="form-error">{{ $message }}</div> @enderror
          </div>
          <div class="fg">
            <label class="fl">Description du litige</label>
            <textarea class="fta" name="description" placeholder="Décrivez votre situation, les démarches déjà effectuées auprès de l'établissement et le préjudice subi...">{{ old('description') }}</textarea>
            @error('description') <div class="form-error">{{ $message }}</div> @enderror
          </div>
          <div class="fg">
            <label class="fl">Pièces justificatives</label>
            <div class="upload-zone" onclick="document.getElementById('saisine-file-input').click()"
                 ondragover="dragOver(event,'saisine-upload-zone')" ondragleave="dragLeave(event,'saisine-upload-zone')"
                 ondrop="dropFiles(event,'saisine-upload-zone','saisine-file-input')" id="saisine-upload-zone">
              <div class="upload-icon"><svg viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg></div>
              <div class="upload-txt">Cliquez ou <strong>glissez-déposez</strong> vos fichiers</div>
              <div class="upload-sub">PDF, JPG, PNG, DOCX — max 10 Mo par fichier — 5 fichiers maximum</div>
            </div>
            <input type="file" id="saisine-file-input" name="pieces[]" style="display:none" multiple accept=".pdf,.jpg,.jpeg,.png,.docx" onchange="renderFileList('saisine-file-input','saisine-file-input-list')">
            <div class="file-list" id="saisine-file-input-list"></div>
            @error('pieces.*') <div class="form-error">{{ $message }}</div> @enderror
          </div>
          <button type="submit" class="btn-or" style="width:100%;justify-content:center;margin-top:4px">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
            Soumettre ma saisine
          </button>
        </form>
      </div>

      <div>
        <h3 style="font-size:19px;font-weight:500;color:var(--txt);margin-bottom:22px">Ce que vous devez savoir</h3>
        <ul class="med-steps">
          <li class="ms-item"><div class="ms-num">1</div><div><div class="ms-t">Réclamation préalable obligatoire</div><div class="ms-d">Adressez d'abord une réclamation écrite à votre établissement. Le recours au CNEF n'est possible qu'après rejet ou absence de réponse dans les <strong>45 jours</strong>. (Décret Art. 7)</div></div></li>
          <li class="ms-item"><div class="ms-num">2</div><div><div class="ms-t">Saisine gratuite — personnes physiques</div><div class="ms-d">La saisine est gratuite. Seules les personnes physiques peuvent saisir le médiateur pour un litige individuel les opposant à un établissement assujetti. (Arrêté 001.25, Art. 2)</div></div></li>
          <li class="ms-item"><div class="ms-num">3</div><div><div class="ms-t">Acceptation par l'autre partie</div><div class="ms-d">L'établissement dispose de <strong>15 jours</strong> pour accepter la médiation. L'absence de réponse dans ce délai vaut refus. (Arrêté 001.25, Art. 4)</div></div></li>
          <li class="ms-item"><div class="ms-num">4</div><div><div class="ms-t">Procédure confidentielle — 3 mois</div><div class="ms-d">La médiation est conduite confidentiellement. Durée maximale : <strong>3 mois</strong>, prorogeable de 2 mois avec accord des parties. L'accord a force obligatoire. (Décret Art. 23 &amp; 29)</div></div></li>
        </ul>
        <div class="med-contacts">
          <div class="mct">Contacts du service de médiation</div>
          <div class="mc-item"><div class="mc-ico"><svg viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg></div><div><div class="mc-lab">Téléphone</div><div class="mc-val">+241 11 72 20 00</div></div></div>
          <div class="mc-item"><div class="mc-ico"><svg viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div><div><div class="mc-lab">Email</div><div class="mc-val"><a href="mailto:mediation@cnef.ga" style="color:inherit">mediation@cnef.ga</a></div></div></div>
          <div class="mc-item"><div class="mc-ico"><svg viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div><div><div class="mc-lab">Adresse</div><div class="mc-val">Boulevard Triomphal, Libreville</div></div></div>
        </div>
      </div>
    </div>
  </div>
  @endif

  {{-- ============ PROCEDURE ============ --}}
  @if ($tab === 'procedure')
  <div class="mtab-panel on" style="max-width:780px">
    <div style="background:var(--gris);border-radius:var(--rl);padding:24px 28px;margin-bottom:24px">
      <div style="font-size:12px;font-weight:500;text-transform:uppercase;letter-spacing:.1em;color:var(--txt3);margin-bottom:16px">Trois branches de médiation — Décret N° 0121/PR/MEP, Art. 4</div>
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(190px,1fr));gap:12px">
        @foreach ($branches as $b)
          <div style="background:#fff;border:1px solid var(--brd);border-radius:var(--r);padding:16px">
            <div style="font-size:10.5px;font-weight:500;text-transform:uppercase;letter-spacing:.1em;color:var(--vert);margin-bottom:6px">Branche {{ $b['num'] }}</div>
            <div style="font-size:13.5px;font-weight:500;color:var(--txt);margin-bottom:4px">{{ $b['titre'] }}</div>
            <div style="font-size:12px;color:var(--txt2)">CNEF sous supervision <strong>{{ $b['supervision'] }}</strong></div>
          </div>
        @endforeach
      </div>
    </div>

    <div style="background:#fee2e2;border:1px solid #fca5a5;border-radius:var(--r);padding:16px 20px;margin-bottom:24px">
      <div style="font-size:12.5px;font-weight:500;color:#b91c1c;margin-bottom:8px">Conditions de recevabilité — Arrêté N° 001.25 MEP, Art. 2</div>
      <div style="font-size:13px;color:#7f1d1d;line-height:1.7">La saisine n'est <strong>pas recevable</strong> si le requérant ne justifie pas avoir tenté de résoudre le litige par réclamation écrite préalable, ou si le litige est déjà en cours d'examen par un autre médiateur, une juridiction ou un tribunal arbitral. Seules les <strong>personnes physiques</strong> peuvent saisir le médiateur pour un litige individuel.</div>
    </div>

    <ul class="med-steps">
      <li class="ms-item"><div class="ms-num">1</div><div><div class="ms-t">Réclamation préalable (45 jours)</div><div class="ms-d">Le consommateur adresse une réclamation écrite à l'établissement. Le recours au médiateur n'est possible qu'en cas de rejet total ou partiel, ou d'absence de suite au terme de <strong>45 jours</strong>. <em>(Décret Art. 7)</em></div></div></li>
      <li class="ms-item"><div class="ms-num">2</div><div><div class="ms-t">Dépôt de la demande de médiation</div><div class="ms-d">La demande datée et signée est adressée au médiateur CNEF avec copie à l'autre partie, accompagnée des coordonnées, de la preuve de réclamation préalable et d'une description détaillée du litige. <em>(Arrêté 001.25, Art. 3)</em></div></div></li>
      <li class="ms-item"><div class="ms-num">3</div><div><div class="ms-t">Acceptation par l'autre partie (15 jours)</div><div class="ms-d">L'établissement dispose de <strong>15 jours</strong> pour confirmer ou infirmer le recours à la médiation. L'absence de réponse implique le rejet de la procédure. <em>(Arrêté 001.25, Art. 4)</em></div></div></li>
      <li class="ms-item"><div class="ms-num">4</div><div><div class="ms-t">Instruction contradictoire et confidentielle (3 mois)</div><div class="ms-d">La procédure est conduite de façon <strong>confidentielle</strong> et contradictoire par écrit. Durée : <strong>3 mois</strong>, prorogeable de <strong>2 mois</strong> avec accord des parties. <em>(Décret Art. 23 ; Arrêté 001.25, Art. 7-12)</em></div></div></li>
      <li class="ms-item"><div class="ms-num">5</div><div><div class="ms-t">Accord exécutoire ou clôture de la procédure</div><div class="ms-d">L'accord issu de la médiation a <strong>force obligatoire</strong> et est susceptible d'exécution forcée. <em>(Décret Art. 27-31)</em></div></div></li>
    </ul>

    <div style="background:var(--vert-c);border:1px solid var(--brd);border-radius:var(--rl);padding:22px 26px;margin-top:28px">
      <div style="font-size:12.5px;font-weight:500;color:var(--vert);margin-bottom:12px">Nomination des médiateurs — Arrêté N° 002.25 MEP, Art. 8 &amp; 11</div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
        <div><div style="font-size:12px;font-weight:500;color:var(--vert);margin-bottom:5px">Désignation</div><div style="font-size:13px;color:var(--txt2);line-height:1.65">Nommés par arrêté de l'Autorité monétaire sur proposition du CNEF, après avis de la COBAC, CIMA ou COSUMAF selon la branche.</div></div>
        <div><div style="font-size:12px;font-weight:500;color:var(--vert);margin-bottom:5px">Mandat</div><div style="font-size:13px;color:var(--txt2);line-height:1.65"><strong>3 ans, renouvelable une fois.</strong> Un médiateur titulaire et un suppléant par branche.</div></div>
      </div>
    </div>
  </div>
  @endif

  {{-- ============ STATS ============ --}}
  @if ($tab === 'stats')
  <div class="mtab-panel on">
    <div class="stats-med-grid">
      @foreach ($mediationKpis as $kpi)
        <div class="smkpi"><div class="smkpi-l">{{ $kpi->libelle }}</div><div class="smkpi-v">{{ $kpi->valeur }}</div><div class="smkpi-s">{{ $kpi->sous_texte }}</div></div>
      @endforeach
    </div>
    <div class="stats-charts">
      <div class="sbox"><div class="sbox-t">Évolution des saisines par trimestre (2022–2024)</div><canvas id="chart-saisines" height="200"></canvas></div>
      <div class="sbox"><div class="sbox-t">Répartition par nature de litige</div><canvas id="chart-litiges" height="200"></canvas></div>
    </div>
    <div class="litiges-table">
      <div class="bt-head bt-grid-5"><span>Nature du litige</span><span>Dossiers</span><span>Résolus</span><span class="bt-hide">Taux</span><span>Tendance</span></div>
      @foreach ($litiges as $l)
        @php($pillClass = ['g' => 'pill-g', 'y' => 'pill-y', 'r' => 'pill-r'][$l->tendance_niveau])
        <div class="bt-row bt-grid-5">
          <span style="font-size:13.5px;font-weight:400">{{ $l->nature }}</span>
          <span style="font-size:13.5px">{{ $l->dossiers }}</span>
          <span style="font-size:13.5px">{{ $l->resolus }}</span>
          <span class="bt-hide"><div class="prog-bar"><div class="prog-fill" style="width:{{ $l->taux }}%"></div></div></span>
          <span><span class="pill {{ $pillClass }}">{{ $l->tendance }}</span></span>
        </div>
      @endforeach
    </div>
  </div>
  @push('scripts')
  <script>
    new Chart(document.getElementById('chart-saisines'), {
      type: 'bar',
      data: {
        labels: @json($saisinesTrimestrielles->pluck('periode')),
        datasets: [
          { label: 'Saisines', data: @json($saisinesTrimestrielles->pluck('saisines')), backgroundColor: 'rgba(5,150,105,0.7)', borderColor: '#059669', borderWidth: 1.5, borderRadius: 4 },
          { label: 'Résolus', data: @json($saisinesTrimestrielles->pluck('resolus')), backgroundColor: 'rgba(232,163,23,0.7)', borderColor: '#E8A317', borderWidth: 1.5, borderRadius: 4 }
        ]
      },
      options: { responsive: true, plugins: { legend: { position: 'bottom' } }, scales: { y: { grid: { color: 'rgba(0,0,0,0.05)' } }, x: { grid: { display: false } } } }
    });
    new Chart(document.getElementById('chart-litiges'), {
      type: 'doughnut',
      data: {
        labels: @json($litiges->pluck('nature')),
        datasets: [{ data: @json($litiges->pluck('dossiers')), backgroundColor: ['#059669', '#E8A317', '#2563EB', '#009A44', '#8B5CF6', '#EF4444'], borderWidth: 2, borderColor: '#fff' }]
      },
      options: { responsive: true, plugins: { legend: { position: 'right', labels: { boxWidth: 12 } } } }
    });
  </script>
  @endpush
  @endif

  {{-- ============ CANDIDATURE ============ --}}
  @if ($tab === 'candidature')
  <div class="mtab-panel on" style="max-width:780px">
    <div style="background:var(--vert-c);border:1px solid var(--brd);border-radius:var(--rl);padding:22px 28px;margin-bottom:28px">
      <div style="font-size:13px;font-weight:500;color:var(--vert);margin-bottom:6px">Appel public à candidature — Arrêté N° 002.25 MEP du 07 janvier 2025, Art. 2</div>
      <div style="font-size:13.5px;color:var(--txt2);line-height:1.7">La procédure de désignation des médiateurs financiers est déclenchée par le CNEF dans le cadre d'un appel public à candidature. Un médiateur titulaire et un médiateur suppléant sont désignés pour chacune des trois branches de médiation.</div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:28px">
      <div style="background:#fff;border:1px solid var(--brd);border-radius:var(--rl);padding:22px">
        <div style="font-size:12px;font-weight:500;text-transform:uppercase;letter-spacing:.1em;color:var(--vert);margin-bottom:14px">Conditions d'éligibilité (Art. 3)</div>
        <div style="font-size:13.5px;color:var(--txt2);line-height:1.75">
          <strong>Branche 1</strong> (crédit, microfinance, paiement) : Master + 5 ans d'expérience <em>ou</em> Licence + 10 ans.<br><br>
          <strong>Branche 2</strong> (assurance) : Mêmes niveaux + expérience dans les assurances.<br><br>
          <strong>Branche 3</strong> (intermédiaires de marché) : Mêmes niveaux + expérience sur les marchés financiers.
        </div>
      </div>
      <div style="background:#fff;border:1px solid var(--brd);border-radius:var(--rl);padding:22px">
        <div style="font-size:12px;font-weight:500;text-transform:uppercase;letter-spacing:.1em;color:var(--vert);margin-bottom:14px">Dossier de candidature (Art. 4)</div>
        <div style="font-size:13px;color:var(--txt2);line-height:1.8">Lettre de motivation · CV · Copies certifiées des diplômes · Attestations de travail · Acte de naissance · 2 photos d'identité · Pièce d'identité · Casier judiciaire (- de 3 mois) · Liste des mandats en cours · Certificat de résidence · Déclaration sur l'honneur · Certificat d'imposition · Attestation de non-faillite.</div>
      </div>
    </div>

    <div style="background:var(--gris);border-radius:var(--rl);padding:24px 28px;margin-bottom:32px">
      <div style="font-size:13px;font-weight:500;color:var(--txt);margin-bottom:10px">Incompatibilités — Art. 17 du Décret N° 0121/PR/MEP</div>
      <div style="font-size:13px;color:var(--txt2);line-height:1.75">Nul ne peut exercer les fonctions de médiateur financier s'il a fait l'objet d'une condamnation pénale pour infraction financière, s'il occupe un poste de responsabilité dans un établissement de crédit, de microfinance, de paiement, une compagnie d'assurance, ou est intermédiaire de marché.</div>
    </div>

    <div style="background:var(--vert-f);border-radius:var(--rl);padding:36px">
      <h3 class="mf-title">Déposer une candidature</h3>
      <p class="mf-sub">Dossier étudié lors du prochain appel à candidature du CNEF</p>

      <form method="POST" action="{{ route('mediation.candidature.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="frow">
          <div class="fg">
            <label class="fl">Prénom</label>
            <input type="text" class="fi" name="prenom" value="{{ old('prenom') }}">
            @error('prenom') <div class="form-error">{{ $message }}</div> @enderror
          </div>
          <div class="fg">
            <label class="fl">Nom</label>
            <input type="text" class="fi" name="nom" value="{{ old('nom') }}">
            @error('nom') <div class="form-error">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="frow">
          <div class="fg">
            <label class="fl">Email</label>
            <input type="email" class="fi" name="email" value="{{ old('email') }}">
            @error('email') <div class="form-error">{{ $message }}</div> @enderror
          </div>
          <div class="fg">
            <label class="fl">Téléphone</label>
            <input type="tel" class="fi" name="telephone" value="{{ old('telephone') }}">
          </div>
        </div>
        <div class="fg">
          <label class="fl">Branche visée</label>
          <select class="fsel" name="branche">
            <option value="">— Sélectionnez —</option>
            @foreach ($branches as $b)
              <option value="Branche {{ $b['num'] }} — {{ $b['titre'] }}" @selected(old('branche') === "Branche {$b['num']} — {$b['titre']}")>Branche {{ $b['num'] }} — {{ $b['titre'] }}</option>
            @endforeach
          </select>
          @error('branche') <div class="form-error">{{ $message }}</div> @enderror
        </div>
        <div class="fg">
          <label class="fl">Lettre de motivation</label>
          <textarea class="fta" name="lettre_motivation" placeholder="Présentez votre parcours et vos motivations...">{{ old('lettre_motivation') }}</textarea>
        </div>
        <div class="fg">
          <label class="fl">Pièces du dossier</label>
          <div class="upload-zone" onclick="document.getElementById('candidature-file-input').click()"
               ondragover="dragOver(event,'candidature-upload-zone')" ondragleave="dragLeave(event,'candidature-upload-zone')"
               ondrop="dropFiles(event,'candidature-upload-zone','candidature-file-input')" id="candidature-upload-zone">
            <div class="upload-icon"><svg viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg></div>
            <div class="upload-txt">Cliquez ou <strong>glissez-déposez</strong> vos fichiers</div>
            <div class="upload-sub">PDF, JPG, PNG, DOCX — max 10 Mo par fichier — 5 fichiers maximum</div>
          </div>
          <input type="file" id="candidature-file-input" name="pieces[]" style="display:none" multiple accept=".pdf,.jpg,.jpeg,.png,.docx" onchange="renderFileList('candidature-file-input','candidature-file-input-list')">
          <div class="file-list" id="candidature-file-input-list"></div>
        </div>
        <button type="submit" class="btn-or" style="width:100%;justify-content:center;margin-top:4px">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
          Envoyer ma candidature
        </button>
      </form>
    </div>
  </div>
  @endif
</section>
@endsection
