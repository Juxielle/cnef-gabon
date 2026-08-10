@extends('layouts.app')

@section('title', 'Éducation financière')
@php($breadcrumb = 'Éducation financière')

@section('content')
<section class="sec" style="background:var(--or-p);padding-top:48px">
  <div class="stag rv">Inclusion financière</div>
  <h2 class="sh rv">Éducation et culture financière</h2>
  <p class="si rv">Le CNEF renforce la culture financière des citoyens gabonais à travers des programmes pédagogiques adaptés à chaque public.</p>

  <div class="edu-grid rv">
    @foreach ($modules as $module)
      <div class="edu-card">
        <div class="edu-ico"><svg viewBox="0 0 24 24">{!! $module['icone'] !!}</svg></div>
        <h4 class="edu-t">{{ $module['titre'] }}</h4>
        <p class="edu-d">{{ $module['description'] }}</p>
        <a href="javascript:void(0)" class="edu-lien">Accéder au module ↗</a>
      </div>
    @endforeach
  </div>
</section>
@endsection
