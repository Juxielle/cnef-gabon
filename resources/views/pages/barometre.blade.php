@extends('layouts.app')

@section('title', 'Baromètre économique')
@php($breadcrumb = 'Baromètre économique')

@section('content')
<div class="baro-hero">
  <div class="baro-live">Mise à jour en temps réel — <span id="baro-time">--:--:--</span></div>
  <h2 class="sh light" style="margin-bottom:8px">Baromètre économique du Gabon</h2>
  <p class="si light" style="margin-bottom:28px;max-width:580px">Le suivi en continu de la santé économique du Gabon, secteur par secteur et branche par branche d'activité.</p>

  <div class="baro-kpis">
    @foreach ($baroKpis as $kpi)
      <div class="bkpi">
        <div class="bkpi-sect">{{ $kpi->secteur }}</div>
        <div class="bkpi-val {{ $kpi->tendance }}">{{ $kpi->valeur }}<span style="font-size:16px;font-weight:300"> {{ $kpi->unite }}</span></div>
        <div class="bkpi-lab">{{ $kpi->libelle }}</div>
        <div class="bkpi-delta {{ $kpi->tendance }}">{{ $kpi->delta }}</div>
      </div>
    @endforeach
  </div>
</div>

<div class="baro-body">
  <div class="baro-nav">
    @foreach ($secteurs as $s)
      <a class="bnav-btn {{ $secteurActif->id === $s->id ? 'on' : '' }}" href="{{ route('barometre.index', ['secteur' => $s->slug]) }}">{{ $s->titre }}</a>
    @endforeach
  </div>

  @php($sClass = $secteurActif->sante === 'bon' ? 'sante-bon' : ($secteurActif->sante === 'moy' ? 'sante-moy' : 'sante-dif'))
  @php($sLabel = $secteurActif->sante === 'bon' ? '✓ Situation saine' : ($secteurActif->sante === 'moy' ? '⚠ Situation mitigée' : '✗ Situation difficile'))

  <div class="secteur-panel on">
    <div class="sect-header">
      <div class="sect-titre">{{ $secteurActif->titre }}</div>
      <span class="sante-badge {{ $sClass }}">{{ $sLabel }}</span>
    </div>

    <div class="baro-kpis" style="margin-bottom:28px">
      @foreach ($secteurActif->kpis as $k)
        <div class="bkpi" style="background:#fff;border-color:var(--brd)">
          <div class="bkpi-sect" style="color:var(--txt3)">{{ $k['l'] }}</div>
          <div class="bkpi-val" style="color:var(--vert);font-size:26px">{{ $k['v'] }}</div>
          <div class="bkpi-delta up">{{ $k['d'] }}</div>
        </div>
      @endforeach
    </div>

    <div class="charts-grid">
      <div class="chart-box">
        <div class="cb-title">{{ $secteurActif->chart_label_1 }}</div>
        <canvas id="chart-1"></canvas>
        <div class="cb-sub">Source : CNEF — données trimestrielles/annuelles</div>
      </div>
      <div class="chart-box">
        <div class="cb-title">{{ $secteurActif->chart_label_2 }}</div>
        <canvas id="chart-2"></canvas>
        <div class="cb-sub">Source : CNEF — données trimestrielles/annuelles</div>
      </div>
    </div>

    <div class="branches-table">
      <div class="bt-head bt-grid-4"><span>Branche / Entité</span><span>Poids / Part</span><span>Indicateur clé</span><span>Évolution</span></div>
      @foreach ($secteurActif->branches as $b)
        @php($pc = $b['note'] === 'Bon' ? 'pill-g' : ($b['note'] === 'Moy' ? 'pill-y' : 'pill-r'))
        @php($barColor = $b['note'] === 'Bon' ? 'var(--vert)' : ($b['note'] === 'Moy' ? '#ca8a04' : '#dc2626'))
        <div class="bt-row bt-grid-4">
          <span style="font-size:13.5px">{{ $b['n'] }}</span>
          <span style="font-size:13.5px">{{ $b['pib'] }}%</span>
          <span><div class="prog-bar"><div class="prog-fill" style="width:{{ min($b['pib'], 100) }}%;background:{{ $barColor }}"></div></div></span>
          <span><span class="pill {{ $pc }}">{{ $b['ev'] > 0 ? '+' : '' }}{{ $b['ev'] }}%</span></span>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  setInterval(() => {
    const el = document.getElementById('baro-time');
    if (el) el.textContent = new Date().toLocaleTimeString('fr-FR');
  }, 1000);

  new Chart(document.getElementById('chart-1'), {
    type: 'line',
    data: {
      labels: @json($secteurActif->chart_categories),
      datasets: [{ data: @json($secteurActif->chart_dataset_1), borderColor: '#059669', backgroundColor: 'rgba(5,150,105,0.08)', tension: .4, pointRadius: 3, pointBackgroundColor: '#059669', fill: true }]
    },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { grid: { color: 'rgba(0,0,0,0.05)' } }, x: { grid: { display: false } } } }
  });
  new Chart(document.getElementById('chart-2'), {
    type: 'bar',
    data: {
      labels: @json($secteurActif->chart_categories),
      datasets: [{ data: @json($secteurActif->chart_dataset_2), backgroundColor: 'rgba(232,163,23,0.7)', borderColor: '#E8A317', borderWidth: 1.5, borderRadius: 4 }]
    },
    options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { grid: { color: 'rgba(0,0,0,0.05)' } }, x: { grid: { display: false } } } }
  });
</script>
@endpush
