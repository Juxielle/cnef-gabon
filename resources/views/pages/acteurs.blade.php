@extends('layouts.app')

@section('title', 'Acteurs réglementés')
@php($breadcrumb = 'Acteurs')

@section('content')
<section class="sec" style="background:var(--vert-f);padding-top:48px">
  <div class="stag light rv">Périmètre de supervision</div>
  <h2 class="sh light rv">Les acteurs réglementés par le CNEF</h2>
  <p class="si light rv">Neuf catégories d'opérateurs financiers relèvent du contrôle du CNEF, aux côtés d'un suivi économique élargi aux principales branches d'activité du pays.</p>
</section>

<section class="sec">
  <div class="acteurs-tabs rv">
    @foreach ($tabs as $key => $label)
      <a class="atab {{ $categorie === $key ? 'on' : '' }}" href="{{ route('acteurs.index', $key === 'tous' ? [] : ['categorie' => $key]) }}">{{ $label }}</a>
    @endforeach
  </div>

  <div class="acteurs-grid rv">
    @forelse ($acteurs as $acteur)
      <div class="acteur-card">
        <div class="ac-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">{!! $acteur->icone_svg !!}</svg></div>
        <div class="ac-nom">{{ $acteur->nom }}</div>
        <div class="ac-desc">{{ $acteur->description }}</div>
        <span class="ac-badge">{{ $acteur->badge }}</span>
      </div>
    @empty
      <p style="color:var(--txt2)">Aucun acteur trouvé pour cette catégorie.</p>
    @endforelse
  </div>
</section>
@endsection
