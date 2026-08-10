@extends('layouts.app')

@section('title', 'Agréments et autorisations')
@php($breadcrumb = 'Agréments')

@section('content')
<div class="hero-sec" style="background:var(--vert-f);padding:70px 5vw 70px">
  <div class="stag light">Réglementation</div>
  <h2 class="sh light">Agréments et autorisations</h2>
  <p class="si light">Le CNEF instruit tout dossier d'agrément financier au Gabon et transmet son avis technique aux autorités compétentes — COBAC, COSUMAF ou Ministère des Finances selon l'activité concernée.</p>

  <div class="agr-grid">
    @foreach ($categories as $cat)
      <div class="agr-box">
        <div class="agr-badge">{{ $cat['badge'] }}</div>
        <h3 class="agr-t">{{ $cat['titre'] }}</h3>
        <p class="agr-d">{{ $cat['description'] }}</p>
        <ul class="agr-ul">
          @foreach ($cat['items'] as $item)
            <li>{{ $item }}</li>
          @endforeach
        </ul>
      </div>
    @endforeach
  </div>

  <div class="proc-wrap">
    <h3 class="proc-t">Procédure d'instruction d'un dossier d'agrément</h3>
    <div class="proc-steps">
      @foreach ($procedure as $i => $step)
        <div class="pstep"><div class="pnum">{{ $i + 1 }}</div><div class="plab">{{ $step }}</div></div>
      @endforeach
    </div>
  </div>
</div>
@endsection
