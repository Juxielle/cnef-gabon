@extends('admin.layouts.app')

@section('title', $item ? 'Modifier — '.$title : 'Ajouter — '.$title)

@section('content')
<div class="admin-card">
  <div class="admin-card-head">
    <h2>{{ $item ? 'Modifier' : 'Nouvel élément' }} — {{ $title }}</h2>
    <a href="{{ route($routeBase.'.index') }}" class="abtn abtn-ghost">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
      Retour à la liste
    </a>
  </div>

  <form method="POST" action="{{ $item ? route($routeBase.'.update', $item->id) : route($routeBase.'.store') }}" enctype="multipart/form-data" style="padding:24px 22px">
    @csrf
    @if ($item) @method('PUT') @endif

    <div class="aform-grid">
      @foreach ($fields as $field)
        @php
          $name = $field['name'];
          $raw = old($name, $item?->{$name});
          if (($field['type'] ?? 'text') === 'json') {
              $raw = old($name, $raw ? json_encode($raw, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : '[]');
          }
        @endphp
        <div class="afg {{ ($field['full'] ?? false) ? 'afg-full' : '' }}">
          @if (($field['type'] ?? 'text') === 'checkbox')
            <label class="afcheck">
              <input type="hidden" name="{{ $name }}" value="0">
              <input type="checkbox" name="{{ $name }}" value="1" @checked(old($name, $item?->{$name}))>
              <span class="afl" style="margin-bottom:0">{{ $field['label'] }}</span>
            </label>
          @else
            <label class="afl">{{ $field['label'] }} @if($field['required'] ?? false)<span class="req">*</span>@endif</label>

            @if ($field['type'] === 'textarea')
              <textarea name="{{ $name }}" class="afta">{{ $raw }}</textarea>
            @elseif ($field['type'] === 'json')
              <textarea name="{{ $name }}" class="afta json">{{ $raw }}</textarea>
            @elseif ($field['type'] === 'select')
              <select name="{{ $name }}" class="afsel">
                <option value="">— Sélectionnez —</option>
                @foreach ($field['options'] as $val => $label)
                  <option value="{{ $val }}" @selected((string) $raw === (string) $val)>{{ $label }}</option>
                @endforeach
              </select>
            @elseif ($field['type'] === 'number')
              <input type="number" step="{{ $field['step'] ?? '1' }}" name="{{ $name }}" class="afi" value="{{ $raw }}">
            @else
              <input type="text" name="{{ $name }}" class="afi" value="{{ $raw }}">
            @endif
          @endif

          @if (isset($field['help']))
            <div class="afhelp">{{ $field['help'] }}</div>
          @endif
          @error($name)
            <div class="aferr">{{ $message }}</div>
          @enderror
        </div>
      @endforeach
    </div>

    <div class="admin-form-actions">
      <button type="submit" class="abtn abtn-primary">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M5 13l4 4L19 7"/></svg>
        {{ $item ? 'Enregistrer les modifications' : 'Créer' }}
      </button>
      <a href="{{ route($routeBase.'.index') }}" class="abtn abtn-ghost">Annuler</a>
    </div>
  </form>
</div>
@endsection
