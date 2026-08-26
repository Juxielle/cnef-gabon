@extends('layouts.app')
@section('title', 'Dépôt et suivi de dossier d’agrément')
@php
  $breadcrumb = 'Suivi dossier d’agrément';
@endphp

@section('content')
<section class="sec agrement-track-hero">
  <div class="stag light">Service en ligne</div>
  <h1 class="sh light">Dépôt et suivi de dossier d’agrément</h1>
  <p class="si light">Transmettez votre demande d’agrément au CNEF et suivez son avancement grâce au numéro unique attribué lors du dépôt.</p>
</section>

<section class="sec agrement-track-page">
  @if(session('dossier_reference'))
    <div class="dossier-confirm"><strong>Dossier transmis avec succès</strong><span>Votre numéro de suivi est :</span><div class="dossier-reference">{{ session('dossier_reference') }}</div><p>Conservez précieusement ce numéro.</p></div>
  @endif

  <div class="track-layout">
    <div class="track-card">
      <div class="stag">Suivre une demande</div><h2>Où en est mon dossier ?</h2>
      <p>Saisissez le numéro remis lors du dépôt, par exemple <strong>AGR-20260822-A1B2C3</strong>.</p>
      <form method="POST" action="{{ route('agrement-dossiers.track') }}" class="track-search-form">
        @csrf <label for="reference">Numéro du dossier</label>
        <div><input id="reference" name="reference" value="{{ old('reference', $reference ?? '') }}" placeholder="AGR-XXXXXXXX-XXXXXX" autocomplete="off" required><button type="submit">Rechercher</button></div>
        @error('reference')<div class="form-error" style="color:#dc2626">{{ $message }}</div>@enderror
      </form>
      @if(isset($reference))
        @if ($dossier)
          @php
            $steps = ['soumis','verification','instruction','avis_transmis','decision'];
            $labels = ['soumis'=>'Dossier soumis','verification'=>'Vérification des pièces','incomplet'=>'Complément requis','instruction'=>'En cours d’instruction','avis_transmis'=>'Avis transmis à l’autorité compétente','decision'=>'Décision disponible','rejete'=>'Dossier rejeté'];
            $current = array_search($dossier->statut, $steps, true);
          @endphp
          <div class="track-result">
            <div class="track-result-top"><span>{{ $dossier->reference }}</span><strong class="status-{{ $dossier->statut }}">{{ $labels[$dossier->statut] ?? $dossier->statut }}</strong></div>
            <dl><div><dt>Demande</dt><dd>{{ $dossier->type_agrement }}</dd></div><div><dt>Déposé le</dt><dd>{{ $dossier->created_at->format('d/m/Y') }}</dd></div></dl>
            @if ($dossier->statut === 'incomplet')
              <div class="track-alert">Des pièces complémentaires sont requises. Le CNEF contactera le responsable du dossier.</div>
            @endif
            @if ($dossier->commentaire_suivi)
              <div class="track-comment"><strong>Information du CNEF</strong><p>{{ $dossier->commentaire_suivi }}</p></div>
            @endif
            @if (!in_array($dossier->statut, ['incomplet', 'rejete']))
              <ol class="track-steps">
                @foreach ($steps as $index => $step)
                  <li class="{{ $current !== false && $index <= $current ? 'done' : '' }} {{ $dossier->statut === $step ? 'current' : '' }}"><i>{{ $index + 1 }}</i><span>{{ $labels[$step] }}</span></li>
                @endforeach
              </ol>
            @endif
          </div>
        @else
          <div class="track-not-found">Aucun dossier ne correspond à ce numéro. Vérifiez la référence saisie ou contactez le CNEF.</div>
        @endif
      @endif
    </div>
    <aside class="track-help"><strong>Avant de commencer</strong><p>Préparez les pièces constitutives correspondant à votre activité. La liste détaillée et les cinq étapes d’instruction sont disponibles dans la rubrique Agréments.</p><a href="{{ route('agrements.index') }}">Consulter la procédure →</a><small>PDF, Word, Excel, JPG et PNG. 10 fichiers maximum, 15 Mo par fichier.</small></aside>
  </div>

  <div class="track-card deposit-card">
    <div class="stag">Nouvelle demande</div><h2>Soumettre un dossier d’agrément</h2>
    <p class="deposit-intro">Les champs marqués d’un astérisque sont obligatoires. Les documents sont conservés dans l’espace privé du CNEF.</p>
    <form method="POST" action="{{ route('agrement-dossiers.store') }}" enctype="multipart/form-data">@csrf
      <h3>Informations sur l’acteur</h3>
      <div class="frow"><div class="fg"><label class="fl">Raison sociale *</label><input class="fi" name="raison_sociale" value="{{ old('raison_sociale') }}" required>@error('raison_sociale')<div class="form-error">{{ $message }}</div>@enderror</div><div class="fg"><label class="fl">Forme juridique</label><input class="fi" name="forme_juridique" value="{{ old('forme_juridique') }}" placeholder="SA, SARL, Coopérative…"></div></div>
      <div class="frow"><div class="fg"><label class="fl">Numéro RCCM</label><input class="fi" name="numero_rccm" value="{{ old('numero_rccm') }}"></div><div class="fg"><label class="fl">Numéro NIF</label><input class="fi" name="numero_nif" value="{{ old('numero_nif') }}"></div></div>
      <div class="fg"><label class="fl">Type d’agrément demandé *</label><select class="fsel" name="type_agrement" required><option value="">— Sélectionnez —</option>@foreach(['Établissement de crédit','Établissement de paiement / monnaie électronique','Intermédiaire de marché / société de gestion','Compagnie ou intermédiaire d’assurance','Institution de microfinance','Bureau de change','Autre activité financière'] as $type)<option @selected(old('type_agrement') === $type)>{{ $type }}</option>@endforeach</select>@error('type_agrement')<div class="form-error">{{ $message }}</div>@enderror</div>
      <h3>Responsable du dossier</h3>
      <div class="frow"><div class="fg"><label class="fl">Nom complet *</label><input class="fi" name="nom_contact" value="{{ old('nom_contact') }}" required>@error('nom_contact')<div class="form-error">{{ $message }}</div>@enderror</div><div class="fg"><label class="fl">Téléphone *</label><input class="fi" type="tel" name="telephone" value="{{ old('telephone') }}" required>@error('telephone')<div class="form-error">{{ $message }}</div>@enderror</div></div>
      <div class="fg"><label class="fl">Adresse email *</label><input class="fi" type="email" name="email" value="{{ old('email') }}" required>@error('email')<div class="form-error">{{ $message }}</div>@enderror</div>
      <div class="fg"><label class="fl">Présentation succincte du projet</label><textarea class="fta" name="description" placeholder="Présentez l’activité envisagée et le périmètre de la demande…">{{ old('description') }}</textarea></div>
      <h3>Pièces constitutives</h3>
      <div class="fg"><div class="upload-zone" id="agrement-upload-zone" onclick="document.getElementById('agrement-file-input').click()" ondragover="dragOver(event,'agrement-upload-zone')" ondragleave="dragLeave(event,'agrement-upload-zone')" ondrop="dropFiles(event,'agrement-upload-zone','agrement-file-input')"><div class="upload-icon"><svg viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg></div><div class="upload-txt">Cliquez ou <strong>glissez-déposez</strong> vos documents</div><div class="upload-sub">PDF, Word, Excel, JPG, PNG — 15 Mo maximum par fichier</div></div><input type="file" id="agrement-file-input" name="pieces[]" hidden multiple required accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png" onchange="renderFileList('agrement-file-input','agrement-file-input-list')"><div class="file-list" id="agrement-file-input-list"></div>@error('pieces')<div class="form-error">{{ $message }}</div>@enderror @error('pieces.*')<div class="form-error">{{ $message }}</div>@enderror</div>
      <label class="deposit-consent"><input type="checkbox" required><span>Je certifie l’exactitude des informations transmises et autorise le CNEF à les utiliser pour l’instruction de cette demande.</span></label>
      <button class="btn-or deposit-submit" type="submit">Transmettre le dossier</button>
    </form>
  </div>
</section>
@endsection
