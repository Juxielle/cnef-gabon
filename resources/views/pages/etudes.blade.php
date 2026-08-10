@extends('layouts.app')

@section('title', 'Études et publications')
@php($breadcrumb = 'Études')

@section('content')
<section class="sec" style="background:var(--gris);padding-top:48px">
  <div class="stag rv">Expertise</div>
  <h2 class="sh rv">Études et publications</h2>
  <p class="si rv">Le CNEF produit des analyses économiques et financières rigoureuses pour éclairer les décisions de politique publique et stimuler la transformation structurelle du Gabon.</p>

  <div style="display:grid;grid-template-columns:1fr 1.2fr;gap:40px;align-items:start">
    <div class="texte-list">
      @foreach ($etudes as $etude)
        <a href="{{ route('etudes.index', ['etude' => $etude->id]) }}" class="texte-item" style="display:block;text-decoration:none;{{ $etudeActive && $etudeActive->id === $etude->id ? 'border-color:var(--vert)' : '' }}">
          <div class="ti-meta"><span class="ti-type">{{ $etude->categorie }}</span><span class="ti-date">{{ $etude->date_publication }}</span></div>
          <div class="ti-titre">{{ $etude->titre }}</div>
        </a>
      @endforeach
    </div>

    <div style="background:#fff;border:1px solid var(--brd);border-radius:var(--rl);padding:32px;position:sticky;top:calc(var(--nav)+12px)">
      @if ($etudeActive)
        <div style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:.12em;color:var(--vert);margin-bottom:12px">{{ $etudeActive->categorie }} · {{ $etudeActive->date_publication }}</div>
        <div style="font-family:'Space Grotesk',sans-serif;font-size:23px;font-weight:600;color:var(--txt);margin-bottom:14px;line-height:1.3">{{ $etudeActive->titre }}</div>
        <div style="font-size:14px;font-weight:300;color:var(--txt2);line-height:1.8;margin-bottom:20px">{{ $etudeActive->description }}</div>
        <div style="display:flex;gap:12px;margin-bottom:24px;flex-wrap:wrap">
          @foreach ($etudeActive->kpis as $k)
            <div style="flex:1;min-width:110px;background:var(--gris);border-radius:8px;padding:14px">
              <div style="font-family:'Space Grotesk',sans-serif;font-size:24px;font-weight:600;color:var(--vert)">{{ $k['v'] }}</div>
              <div style="font-size:12px;color:var(--txt3);line-height:1.4">{{ $k['l'] }}</div>
            </div>
          @endforeach
        </div>
        <a href="{{ $etudeActive->fichier ? asset('assets/documents/' . $etudeActive->fichier) : '#' }}" style="display:inline-flex;align-items:center;gap:8px;background:var(--vert);color:#fff;font-size:13.5px;padding:11px 22px;border-radius:8px;text-decoration:none">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
          Télécharger ({{ $etudeActive->nombre_pages }} pages)
        </a>
      @else
        <p style="color:var(--txt2)">Aucune étude publiée pour le moment.</p>
      @endif
    </div>
  </div>
</section>
@endsection
