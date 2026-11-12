@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<h1 class="text-xl font-bold mb-4">Dashboard</h1>
<div class="grid lg:grid-cols-3 gap-4">
  <section class="panel lg:col-span-2"><h2 class="font-semibold mb-2">Distribusi sentimen</h2>
    <div class="card h-64">@if($total)<canvas id="pie"></canvas>@else<p class="grid h-full place-items-center">Belum ada hasil analisis. Mulai dari menu Analisis Data.</p>@endif</div></section>
  <section class="space-y-4">
    <div class="panel"><div class="text-sm">Total ulasan dianalisis</div><div class="card text-center text-2xl font-bold">{{ $total }}</div></div>
    <div class="panel"><div class="text-sm">Rata-rata keyakinan model</div><div class="card text-center text-2xl font-bold">{{ $avg }}%</div></div>
    @if($pending)<div class="panel text-sm">{{ $pending }} ulasan menunggu diproses.</div>@endif
  </section>
  <section class="panel lg:col-span-3"><h2 class="font-semibold mb-2">Tren ulasan 30 hari terakhir</h2><div class="card h-56"><canvas id="line"></canvas></div></section>
</div>
@endsection
@push('scripts')
<script>
const css=n=>getComputedStyle(document.documentElement).getPropertyValue(n).trim();
const d=@json($dist), t=@json($trend);
if(document.getElementById('pie'))new Chart(pie,{type:'pie',data:{labels:['Positif','Netral','Negatif'],datasets:[{data:[d.positif,d.netral,d.negatif],backgroundColor:[css('--pos'),css('--neu'),css('--neg')]}]},options:{maintainAspectRatio:false,plugins:{legend:{position:'right'}}}});
new Chart(line,{type:'line',data:{labels:Object.keys(t),datasets:[{label:'Ulasan',data:Object.values(t),borderColor:css('--side'),tension:.3}]},options:{maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{y:{beginAtZero:true,ticks:{precision:0}}}}});
</script>
@endpush
