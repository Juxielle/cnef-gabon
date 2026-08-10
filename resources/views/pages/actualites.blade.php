@extends('layouts.app')

@section('title', 'Actualités')
@php
  $breadcrumb = 'Actualités';
@endphp

@section('content')
<div style="background:var(--vert-f);padding:36px 5vw 0;position:sticky;top:var(--nav);z-index:50">
  <p style="font-size:11px;font-weight:500;letter-spacing:.14em;text-transform:uppercase;color:var(--or);margin-bottom:6px">Communication &amp; veille mondiale</p>
  <h2 style="font-family:'Space Grotesk',sans-serif;font-size:30px;font-weight:600;color:#fff;margin-bottom:20px;line-height:1.15">Actualités du CNEF &amp; innovation financière mondiale</h2>
  <div style="display:flex;gap:0">
    <a href="{{ route('actualites.index', ['tab' => 'cnef']) }}" class="actu-tab {{ $tab === 'cnef' ? 'actu-tab-on' : '' }}">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>
      Communiqués CNEF
    </a>
    <a href="{{ route('actualites.index', ['tab' => 'veille']) }}" class="actu-tab {{ $tab === 'veille' ? 'actu-tab-on' : '' }}">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 010 20"/></svg>
      Veille Innovation Mondiale
      <span class="atab-ai-badge">IA</span>
    </a>
  </div>
</div>

@if ($tab === 'cnef')
  <div style="padding:30px 5vw">
    <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:24px">
      @foreach ($cnefFiltres as $key => $label)
        <a class="af-btn {{ $categorieCnef === $key ? 'on' : '' }}" href="{{ route('actualites.index', ['tab' => 'cnef', 'categorie' => $key]) }}">{{ $label }}</a>
      @endforeach
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:18px">
      @forelse ($actualites as $actu)
        <div class="actu-card-new">
          <div class="acn-img" style="background:{{ $actu->fond_couleur }}">
            <span class="acn-badge" style="background:{{ $actu->badge_couleur }};color:{{ $actu->badge_couleur === '#E8A317' ? 'var(--vert-f)' : '#fff' }}">{{ $actu->badge_label }}</span>
          </div>
          <div class="acn-body">
            <div class="acn-date">{{ $actu->date_publication }}</div>
            <div class="acn-titre">{{ $actu->titre }}</div>
            <div class="acn-txt">{{ $actu->contenu }}</div>
          </div>
        </div>
      @empty
        <p style="color:var(--txt2)">Aucune actualité pour cette catégorie.</p>
      @endforelse
    </div>
  </div>
@else
  <div style="padding:30px 5vw">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px">
      <div style="display:flex;gap:5px;flex-wrap:wrap">
        @foreach ($veilleFiltres as $key => $label)
          <a class="af-btn {{ $categorieVeille === $key ? 'on' : '' }}" href="{{ route('actualites.index', ['tab' => 'veille', 'veille_categorie' => $key]) }}">{{ $label }}</a>
        @endforeach
      </div>
    </div>

    @php
      $catStyle = [
        'fintech' => ['bg' => '#e0f2fe', 'color' => '#0369a1', 'bar' => '#0ea5e9', 'label' => 'Fintech & Innovation'],
        'monetaire' => ['bg' => '#dcfce7', 'color' => '#15803d', 'bar' => 'var(--vert)', 'label' => 'Politique monétaire'],
        'numerique' => ['bg' => '#ede9fe', 'color' => '#6d28d9', 'bar' => '#8b5cf6', 'label' => 'Économie numérique'],
        'verte' => ['bg' => '#f0fdf4', 'color' => '#166534', 'bar' => '#22c55e', 'label' => 'Finance verte'],
        'ia' => ['bg' => '#fef9c3', 'color' => '#92400e', 'bar' => '#f59e0b', 'label' => 'IA & Finance'],
        'crypto' => ['bg' => '#fce7f3', 'color' => '#9d174d', 'bar' => '#ec4899', 'label' => 'CBDC & Crypto'],
      ];
      $impStyle = [
        'Élevé' => ['bg' => '#fee2e2', 'color' => '#b91c1c'],
        'Moyen' => ['bg' => '#fef9c3', 'color' => '#92400e'],
        'Faible' => ['bg' => '#f1f5f9', 'color' => '#64748b'],
      ];
    @endphp

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:18px">
      @forelse ($veilleItems as $item)
        @php
          $cs = $catStyle[$item->categorie] ?? $catStyle['fintech'];
          $is = $impStyle[$item->impact] ?? $impStyle['Moyen'];
        @endphp
        <div style="background:#fff;border:1px solid var(--brd);border-radius:var(--rl);overflow:hidden">
          <div style="height:4px;background:{{ $cs['bar'] }}"></div>
          <div style="padding:18px 18px 0">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:8px;margin-bottom:11px">
              <span style="font-size:10.5px;font-weight:600;letter-spacing:.09em;text-transform:uppercase;background:{{ $cs['bg'] }};color:{{ $cs['color'] }};padding:3px 10px;border-radius:100px">{{ $cs['label'] }}</span>
              <span style="font-size:10.5px;font-weight:500;background:{{ $is['bg'] }};color:{{ $is['color'] }};padding:3px 10px;border-radius:100px;white-space:nowrap">▲ {{ $item->impact }}</span>
            </div>
            <div style="font-size:15px;font-weight:500;color:var(--txt);line-height:1.4;margin-bottom:10px">{{ $item->titre }}</div>
            <div style="font-size:13px;font-weight:300;color:var(--txt2);line-height:1.68;margin-bottom:12px">{{ $item->resume }}</div>
            @if ($item->pertinence_afrique)
              <div style="background:var(--vert-c);border-radius:7px;padding:9px 12px;font-size:12px;color:var(--vert);line-height:1.55;margin-bottom:12px"><strong>Pertinence Gabon/Afrique :</strong> {{ $item->pertinence_afrique }}</div>
            @endif
          </div>
          <div style="padding:0 18px 16px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:6px">
            <div style="display:flex;gap:5px;flex-wrap:wrap">
              @foreach ($item->tags ?? [] as $tag)
                <span style="font-size:11px;background:var(--gris);color:var(--txt3);padding:3px 9px;border-radius:100px">{{ $tag }}</span>
              @endforeach
            </div>
            <div style="text-align:right">
              <div style="font-size:11px;color:var(--txt3)">{{ $item->source }}</div>
              <div style="font-size:10.5px;color:var(--txt3)">{{ $item->region }} · {{ $item->date_publication }}</div>
            </div>
          </div>
        </div>
      @empty
        <p style="color:var(--txt2)">Aucun élément de veille pour cette catégorie.</p>
      @endforelse
    </div>

    <div style="margin-top:22px;padding:12px 18px;background:var(--gris);border-radius:8px;font-size:12px;color:var(--txt3);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px">
      <span>Synthèse IA (Claude + web search). Pour décision, consultez les sources d'origine.</span>
      <span>Contenu au {{ now()->translatedFormat('d F Y') }}</span>
    </div>
  </div>
@endif
@endsection
