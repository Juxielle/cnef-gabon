@extends('layouts.app')

@section('title', 'Veille réglementaire')
@php($breadcrumb = 'Veille réglementaire')

@section('content')
<section class="sec" style="background:var(--vert-f);padding-top:48px;padding-bottom:50px">
  <div class="stag light">Veille réglementaire</div>
  <h2 class="sh light">Veille économique et financière</h2>
  <p class="si light">L'ensemble des textes officiels applicables aux acteurs financiers opérant au Gabon — règlements CEMAC, décrets, arrêtés et instructions. Conformément à l'article 9 du Règlement N° 03/2019/CEMAC/UMAC/CM, le CNEF veille à ce que l'information destinée aux consommateurs de services financiers reste accessible, claire et compréhensible.</p>
</section>

<section class="sec" style="padding-top:40px">
  <div class="veille-layout">
    @include('partials.sidebar')

    <div class="texte-list">
      @forelse ($textes as $texte)
        <div class="texte-item">
          <div class="ti-meta">
            <span class="ti-type">{{ $texte->type }}</span>
            <span class="ti-date">{{ $texte->date_publication }}</span>
            <span class="ti-ref">{{ $texte->reference }}</span>
          </div>
          <div class="ti-titre">{{ $texte->titre }}</div>
          <div class="ti-desc">{{ $texte->description }}</div>
          <div class="ti-footer">
            @if ($texte->fichier)
              <span style="display:inline-flex;align-items:center;gap:6px;font-size:11.5px;font-weight:500;background:#dcfce7;color:#15803d;padding:4px 12px;border-radius:100px">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="9"/></svg>
                Document officiel disponible
              </span>
              <a href="{{ asset('assets/documents/' . $texte->fichier) }}" class="ti-dl" target="_blank">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Télécharger le texte
              </a>
            @endif
          </div>
        </div>
      @empty
        <p style="color:var(--txt2)">Aucun texte trouvé pour cette catégorie.</p>
      @endforelse
    </div>
  </div>
</section>
@endsection
