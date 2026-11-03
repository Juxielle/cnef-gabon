@extends('admin.layouts.app')

@section('title', 'Tableau de bord')
@section('subtitle', 'Vue d\'ensemble du contenu et des demandes du site CNEF Gabon')

@section('content')

<div class="stag" style="margin-bottom:10px">Contenu du site</div>
<div class="admin-stats-grid">
  @foreach ($stats as $s)
    <a href="{{ route($s['route']) }}" class="admin-stat" style="text-decoration:none;display:block">
      <div class="admin-stat-v">{{ $s['value'] }}</div>
      <div class="admin-stat-l">{{ $s['label'] }}</div>
    </a>
  @endforeach
</div>

<div class="stag" style="margin-bottom:10px">En attente de traitement</div>
<div class="admin-stats-grid" style="margin-bottom:32px">
  @foreach ($pending as $p)
    <a href="{{ route($p['route']) }}" class="admin-stat" style="text-decoration:none;display:block;{{ $p['value'] > 0 ? 'border-color:var(--or)' : '' }}">
      <div class="admin-stat-v" style="color:{{ $p['value'] > 0 ? 'var(--or-d)' : 'var(--vert)' }}">{{ $p['value'] }}</div>
      <div class="admin-stat-l">{{ $p['label'] }}</div>
    </a>
  @endforeach
</div>

<div class="stag" style="margin-bottom:10px">Accès rapide</div>
<div class="admin-quick-grid">
  <a class="admin-quick" href="{{ route('admin.acteurs.create') }}">
    <div class="admin-quick-ico"><svg viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg></div>
    <div><div class="admin-quick-t">Ajouter un acteur</div><div class="admin-quick-d">Nouvelle entité réglementée</div></div>
  </a>
  <a class="admin-quick" href="{{ route('admin.actualites.create') }}">
    <div class="admin-quick-ico"><svg viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg></div>
    <div><div class="admin-quick-t">Publier une actualité</div><div class="admin-quick-d">Communiqué CNEF</div></div>
  </a>
  <a class="admin-quick" href="{{ route('admin.textes.create') }}">
    <div class="admin-quick-ico"><svg viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg></div>
    <div><div class="admin-quick-t">Ajouter un texte</div><div class="admin-quick-d">Veille réglementaire</div></div>
  </a>
  <a class="admin-quick" href="{{ route('admin.messages.index') }}">
    <div class="admin-quick-ico"><svg viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
    <div><div class="admin-quick-t">Messages reçus</div><div class="admin-quick-d">Formulaire de contact</div></div>
  </a>
</div>


@endsection
