@php
    $isMediation = request()->routeIs('mediation.*');
    $isRegulation = request()->routeIs('acteurs.*', 'agrements.*', 'agrement-dossiers.*', 'veille.*');
    $isRessources = request()->routeIs('education.*', 'actualites.*', 'liens.*');
@endphp

@if ($isMediation)
{{-- ========================================================================= --}}
{{-- ── MENU SPÉCIFIQUE : PORTAIL NUMÉRIQUE DE LA MÉDIATION FINANCIÈRE ──       --}}
{{-- ========================================================================= --}}
<nav class="site-nav site-nav-mediation" aria-label="Navigation Médiation Financière">
  <a href="{{ route('mediation.index') }}" class="nav-logo" style="display:flex;align-items:center;gap:12px;flex-shrink:0;text-decoration:none">
    <img class="nav-emb" src="{{ asset('assets/images/logo-semi-trans.png') }}" alt="Logo CNEF">
    <div class="nav-txt">
      <span style="display:flex;align-items:center;gap:8px">
        CNEF Gabon
        <span class="nav-med-badge">Médiation</span>
      </span>
      <span>Médiation Financière</span>
    </div>
  </a>

  <div class="nav-menu">
    {{-- Retour vers le portail général CNEF --}}
    <a class="nav-btn nav-back-cnef" href="{{ route('home') }}" title="Retourner à l'accueil du portail CNEF">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
      Portail CNEF
    </a>

    <span class="nav-sep"></span>

    {{-- 1. ACCUEIL --}}
    <a class="nav-btn {{ request()->routeIs('mediation.index') ? 'active' : '' }}" href="{{ route('mediation.index') }}">
      Accueil
    </a>

    {{-- 2. PRÉSENTATION --}}
    <a class="nav-btn {{ request()->routeIs('mediation.presentation') ? 'active' : '' }}" href="{{ route('mediation.presentation') }}">
      Présentation
    </a>

    {{-- 3. RECOURS À LA MÉDIATION (Menu déroulant & lien direct) --}}
    @php
      $isRecoursActive = request()->routeIs('mediation.recours*', 'mediation.suivi*', 'mediation.activites*');
    @endphp
    <div class="nav-dropdown" id="nav-dropdown-recours">
      <button class="nav-btn nav-dd-trigger {{ $isRecoursActive ? 'active' : '' }}" type="button" onclick="toggleDropdown(event,'recours')">
        Recours à la médiation
        <svg class="nav-dd-arrow" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
      </button>
      <div class="nav-dd-menu" id="nav-dd-menu-recours">
        <a class="nav-dd-item {{ request()->routeIs('mediation.recours') ? 'active' : '' }}" href="{{ route('mediation.recours') }}">
          Recours à la médiation (Vue générale)
        </a>
        <a class="nav-dd-item" href="{{ route('mediation.recours') }}#saisine-info">
          1. Saisine du Médiateur
        </a>
        <a class="nav-dd-item" href="{{ route('mediation.recours') }}#voies-saisine">
          2. Voies de saisine
        </a>
        <a class="nav-dd-item" href="{{ route('mediation.recours') }}#formulaire">
          3. Demande de médiation (En ligne)
        </a>
        <a class="nav-dd-item {{ request()->routeIs('mediation.suivi*') ? 'active' : '' }}" href="{{ route('mediation.suivi') }}">
          4. Suivi des demandes
        </a>
        <a class="nav-dd-item" href="{{ route('mediation.recours') }}#faq">
          5. Foire aux questions (FAQ)
        </a>
      </div>
    </div>

    {{-- Menu déroulant : Informations utiles (Établissements adhérents, Fonds documentaire, Contacts utiles) --}}
    @php
      $isInfosActive = request()->routeIs('mediation.adherents*', 'mediation.fonds-documentaire*', 'mediation.textes*', 'mediation.contacts*');
    @endphp
    <div class="nav-dropdown" id="nav-dropdown-infos">
      <button class="nav-btn nav-dd-trigger {{ $isInfosActive ? 'active' : '' }}" type="button" onclick="toggleDropdown(event,'infos')">
        Informations utiles
        <svg class="nav-dd-arrow" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
      </button>
      <div class="nav-dd-menu" id="nav-dd-menu-infos">
        <a class="nav-dd-item {{ request()->routeIs('mediation.adherents*') ? 'active' : '' }}" href="{{ route('mediation.adherents') }}">
          Établissements adhérents
        </a>
        <a class="nav-dd-item {{ request()->routeIs('mediation.fonds-documentaire*', 'mediation.textes*') ? 'active' : '' }}" href="{{ route('mediation.fonds-documentaire') }}">
          Fonds documentaire
        </a>
        <a class="nav-dd-item {{ request()->routeIs('mediation.contacts*') ? 'active' : '' }}" href="{{ route('mediation.contacts') }}">
          Contacts utiles
        </a>
      </div>
    </div>

    <span class="nav-sep"></span>

    {{-- CTA saisine rapide --}}
    <a class="nav-btn nav-cta" href="{{ route('mediation.recours') }}#formulaire">
      Saisir le Médiateur
    </a>

    {{-- Sélecteur de langue --}}
    <form class="language-switcher" aria-label="Choisir la langue">
      <label for="site-language-med" class="sr-only">Choisir la langue</label>
      <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 010 18M12 3a15 15 0 000 18"/></svg>
      <select id="site-language-med" aria-label="Choisir la langue" onchange="if(this.value) window.location.href=this.value">
        @foreach (config('locales.supported', []) as $code => $language)
          <option value="{{ route('locale.switch', $code) }}" lang="{{ $code }}" @selected(app()->getLocale() === $code)>
            {{ $language['label'] }}
          </option>
        @endforeach
      </select>
    </form>
  </div>
</nav>

@else
{{-- ========================================================================= --}}
{{-- ── MENU PRINCIPAL DU CNEF ──                                              --}}
{{-- ========================================================================= --}}
<nav class="site-nav" aria-label="Navigation principale CNEF">
  <a href="{{ route('home') }}" class="nav-logo" style="display:flex;align-items:center;gap:12px;flex-shrink:0;text-decoration:none">
    <img class="nav-emb" src="{{ asset('assets/images/logo-semi-trans.png') }}" alt="Logo CNEF">
    <div class="nav-txt">
      <span>CNEF Gabon</span>
      <span>Comité National Économique et Financier</span>
    </div>
  </a>

  <div class="nav-menu">
    <a class="nav-btn {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Accueil</a>
    <span class="nav-sep"></span>

    <div class="nav-dropdown" id="nav-dropdown-regulation">
      <button class="nav-btn nav-dd-trigger {{ $isRegulation ? 'active' : '' }}" type="button" onclick="toggleDropdown(event,'regulation')">
        Régulation
        <svg class="nav-dd-arrow" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
      </button>
      <div class="nav-dd-menu" id="nav-dd-menu-regulation">
        <a class="nav-dd-item {{ request()->routeIs('acteurs.*') ? 'active' : '' }}" href="{{ route('acteurs.index') }}">Acteurs</a>
        <a class="nav-dd-item {{ request()->routeIs('agrements.*') ? 'active' : '' }}" href="{{ route('agrements.index') }}">Agréments</a>
        <a class="nav-dd-item {{ request()->routeIs('veille.*') ? 'active' : '' }}" href="{{ route('veille.index') }}">Veille réglementaire</a>
        <a class="nav-dd-item {{ request()->routeIs('agrement-dossiers.*') ? 'active' : '' }}" href="{{ route('agrement-dossiers.index') }}">Suivi dossier d'Agrément</a>
      </div>
    </div>
    <span class="nav-sep"></span>

    <a class="nav-btn nav-baro {{ request()->routeIs('barometre.*') ? 'active' : '' }}" href="{{ route('barometre.index') }}">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 20V10M18 20V4M6 20v-4"/></svg>
      Baromètre éco.
    </a>
    <a class="nav-btn {{ request()->routeIs('etudes.*') ? 'active' : '' }}" href="{{ route('etudes.index') }}">Études</a>
    <span class="nav-sep"></span>

    <div class="nav-dropdown" id="nav-dropdown-ressources">
      <button class="nav-btn nav-dd-trigger {{ $isRessources ? 'active' : '' }}" type="button" onclick="toggleDropdown(event,'ressources')">
        Ressources
        <svg class="nav-dd-arrow" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
      </button>
      <div class="nav-dd-menu" id="nav-dd-menu-ressources">
        <a class="nav-dd-item {{ request()->routeIs('education.*') ? 'active' : '' }}" href="{{ route('education.index') }}">Éducation financière</a>
        <a class="nav-dd-item {{ request()->routeIs('actualites.*') ? 'active' : '' }}" href="{{ route('actualites.index') }}">Actualités</a>
        <a class="nav-dd-item {{ request()->routeIs('liens.*') ? 'active' : '' }}" href="{{ route('liens.index') }}">Liens</a>
      </div>
    </div>

    {{-- Clic vers la Médiation : bascule vers le sous-site Médiation et son menu propre --}}
    <a class="nav-btn nav-cta" href="{{ route('mediation.index') }}">Médiation</a>

    <form class="language-switcher" aria-label="Choisir la langue">
      <label for="site-language" class="sr-only">Choisir la langue</label>
      <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 010 18M12 3a15 15 0 000 18"/></svg>
      <select id="site-language" aria-label="Choisir la langue" onchange="if(this.value) window.location.href=this.value">
        @foreach (config('locales.supported', []) as $code => $language)
          <option value="{{ route('locale.switch', $code) }}" lang="{{ $code }}" @selected(app()->getLocale() === $code)>
            {{ $language['label'] }}
          </option>
        @endforeach
      </select>
    </form>
  </div>
</nav>
@endif
