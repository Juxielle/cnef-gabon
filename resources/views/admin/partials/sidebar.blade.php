<aside class="admin-sidebar" id="admin-sidebar">
  <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-brand" style="text-decoration:none">
    <img class="admin-sidebar-emb" src="{{ asset('assets/images/logo-cnef.jpeg') }}" alt="Logo CNEF">
    <span><span>CNEF Gabon</span><span>Back-office</span></span>
  </a>

  <nav class="admin-nav">
    <a class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
      <svg viewBox="0 0 24 24"><path d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0h6m-6 0V15h6v6"/></svg>
      Tableau de bord
    </a>

    <div class="admin-nav-group">Contenu du site</div>
    <a class="admin-nav-link {{ request()->routeIs('admin.acteurs.*') ? 'active' : '' }}" href="{{ route('admin.acteurs.index') }}">
      <svg viewBox="0 0 24 24"><path d="M3 21h18M3 10h18M3 7l9-4 9 4M4 10v11M20 10v11"/></svg>
      Acteurs <span class="admin-nav-count">{{ \App\Models\Acteur::count() }}</span>
    </a>
    <a class="admin-nav-link {{ request()->routeIs('admin.textes.*') ? 'active' : '' }}" href="{{ route('admin.textes.index') }}">
      <svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 016.5 17H20M4 19.5A2.5 2.5 0 006.5 22H20V2H6.5A2.5 2.5 0 004 4.5v15z"/></svg>
      Veille réglementaire <span class="admin-nav-count">{{ \App\Models\TexteReglementaire::count() }}</span>
    </a>
    <a class="admin-nav-link {{ request()->routeIs('admin.etudes.*') ? 'active' : '' }}" href="{{ route('admin.etudes.index') }}">
      <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
      Études <span class="admin-nav-count">{{ \App\Models\Etude::count() }}</span>
    </a>
    <a class="admin-nav-link {{ request()->routeIs('admin.actualites.*') ? 'active' : '' }}" href="{{ route('admin.actualites.index') }}">
      <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>
      Actualités CNEF <span class="admin-nav-count">{{ \App\Models\Actualite::count() }}</span>
    </a>
    <a class="admin-nav-link {{ request()->routeIs('admin.veille-innovations.*') ? 'active' : '' }}" href="{{ route('admin.veille-innovations.index') }}">
      <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20"/></svg>
      Veille innovation <span class="admin-nav-count">{{ \App\Models\VeilleInnovation::count() }}</span>
    </a>
    <a class="admin-nav-link {{ request()->routeIs('admin.liens.*') ? 'active' : '' }}" href="{{ route('admin.liens.index') }}">
      <svg viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
      Liens utiles <span class="admin-nav-count">{{ \App\Models\LienUtile::count() }}</span>
    </a>

    <div class="admin-nav-group">Baromètre économique</div>
    <a class="admin-nav-link {{ request()->routeIs('admin.secteurs.*') ? 'active' : '' }}" href="{{ route('admin.secteurs.index') }}">
      <svg viewBox="0 0 24 24"><path d="M12 20V10M18 20V4M6 20v-4"/></svg>
      Secteurs économiques <span class="admin-nav-count">{{ \App\Models\SecteurEconomique::count() }}</span>
    </a>
    <a class="admin-nav-link {{ request()->routeIs('admin.baro-kpis.*') ? 'active' : '' }}" href="{{ route('admin.baro-kpis.index') }}">
      <svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622"/></svg>
      Indicateurs clés <span class="admin-nav-count">{{ \App\Models\BaroKpi::count() }}</span>
    </a>

    <div class="admin-nav-group">Médiation financière</div>
    <a class="admin-nav-link {{ request()->routeIs('admin.mediation-requests.*') ? 'active' : '' }}" href="{{ route('admin.mediation-requests.index') }}">
      <svg viewBox="0 0 24 24"><path d="M12 3v18M5 7l-3 6a3 3 0 006 0zM19 7l-3 6a3 3 0 006 0zM5 7h14"/></svg>
      Saisines reçues <span class="admin-nav-count">{{ \App\Models\MediationRequest::count() }}</span>
    </a>
    <a class="admin-nav-link {{ request()->routeIs('admin.mediation-kpis.*') ? 'active' : '' }}" href="{{ route('admin.mediation-kpis.index') }}">
      <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      Statistiques litiges <span class="admin-nav-count">{{ \App\Models\MediationKpi::count() }}</span>
    </a>
    <a class="admin-nav-link {{ request()->routeIs('admin.mediation-litiges.*') ? 'active' : '' }}" href="{{ route('admin.mediation-litiges.index') }}">
      <svg viewBox="0 0 24 24"><path d="M9 17V9m4 8V5m4 12v-6M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
      Nature des litiges <span class="admin-nav-count">{{ \App\Models\MediationLitige::count() }}</span>
    </a>
    <a class="admin-nav-link {{ request()->routeIs('admin.mediation-saisines.*') ? 'active' : '' }}" href="{{ route('admin.mediation-saisines.index') }}">
      <svg viewBox="0 0 24 24"><path d="M3 3v18h18M7 15l4-4 3 3 5-6"/></svg>
      Saisines / trimestre <span class="admin-nav-count">{{ \App\Models\MediationSaisineTrimestre::count() }}</span>
    </a>
    <a class="admin-nav-link {{ request()->routeIs('admin.candidatures.*') ? 'active' : '' }}" href="{{ route('admin.candidatures.index') }}">
      <svg viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      Candidatures médiateur <span class="admin-nav-count">{{ \App\Models\MediateurCandidature::count() }}</span>
    </a>

    <div class="admin-nav-group">Communication</div>
    <a class="admin-nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}">
      <svg viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      Messages de contact <span class="admin-nav-count">{{ \App\Models\ContactMessage::count() }}</span>
    </a>
  </nav>

  <div class="admin-sidebar-foot">
    <div class="admin-sidebar-user">
      Connecté en tant que<br>
      <strong>{{ auth()->user()->name }}</strong>
    </div>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="admin-logout">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/></svg>
        Se déconnecter
      </button>
    </form>
  </div>
</aside>
