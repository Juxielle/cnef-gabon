@extends('layouts.app')

@section('title', 'Liens institutionnels')
@php($breadcrumb = 'Liens utiles')

@section('content')
<section class="sec" style="background:var(--vert-f);padding-top:48px;padding-bottom:50px">
  <div class="stag light">Portail institutionnel</div>
  <h2 class="sh light">Liens institutionnels</h2>
  <p class="si light">Accédez aux sites des institutions financières internationales, des banques centrales et des régulateurs partenaires du CNEF.</p>
</section>

<div class="liens-sec">
  @foreach ($groupes as $groupe => $liens)
    <div class="liens-cat">
      <div class="lcat-titre">{{ $groupe }}</div>
      <div class="liens-grid">
        @foreach ($liens as $lien)
          @php($isDeploy = $lien->statut === 'En déploiement')
          <{{ $isDeploy ? 'div' : 'a' }} class="lien-card" @if(!$isDeploy) href="{{ $lien->url }}" target="_blank" rel="noopener" @endif style="{{ $isDeploy ? 'cursor:default;opacity:.7' : '' }}">
            @if ($lien->drapeau_svg)
              {!! $lien->drapeau_svg !!}
            @else
              <div style="width:44px;height:28px;border-radius:4px;background:var(--gris);display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:600;color:var(--txt3);margin-bottom:10px">
                {{ substr(collect(explode(' ', $lien->nom))->map(fn($w) => $w[0] ?? '')->implode(''), 0, 3) }}
              </div>
            @endif
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:6px;margin-bottom:3px">
              <div class="lc-nom">{{ $lien->nom }}</div>
              <span style="font-size:9.5px;font-weight:600;background:{{ $lien->statut === 'Actif' ? '#dcfce7' : '#f1f5f9' }};color:{{ $lien->statut === 'Actif' ? '#15803d' : '#64748b' }};padding:2px 7px;border-radius:100px;white-space:nowrap;flex-shrink:0">{{ $lien->statut }}</span>
            </div>
            @if ($lien->pays)
              <div style="font-size:11px;color:var(--txt3);margin-bottom:4px">{{ $lien->capitale }} · {{ $lien->pays }}</div>
            @endif
            <div class="lc-desc">{{ $lien->description }}</div>
            @if (!$isDeploy)
              <div class="lc-ext" style="margin-top:10px">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Ouvrir le site
              </div>
            @else
              <div style="margin-top:10px;font-size:11px;color:#94a3b8;display:flex;align-items:center;gap:5px">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg>
                Site en cours de déploiement
              </div>
            @endif
          </{{ $isDeploy ? 'div' : 'a' }}>
        @endforeach
      </div>
    </div>
  @endforeach
</div>
@endsection
