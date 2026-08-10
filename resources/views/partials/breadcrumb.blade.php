@isset($breadcrumb)
<nav aria-label="Fil d'Ariane" style="padding:14px 5vw;background:var(--gris);border-bottom:1px solid var(--brd);font-size:12.5px">
  <a href="{{ route('home') }}" style="color:var(--txt3);text-decoration:none">Accueil</a>
  <span style="color:var(--txt3);margin:0 6px">/</span>
  <span style="color:var(--txt);font-weight:500">{{ $breadcrumb }}</span>
</nav>
@endisset
