<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Sentimen Analisis e-Samsat')</title>
<script src="https://cdn.tailwindcss.com/3.4.17"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<style>
:root{--bg:#c3deff;--panel:#8fb3e0;--card:#dcebff;--side:#3c4657;--side-t:#e6edf7;--ink:#14233b;--line:#6f94c4;--pos:#2e9e5b;--neu:#7a8696;--neg:#d64545}
.dark{--bg:#2b3340;--panel:#3a4556;--card:#465266;--side:#1d232d;--side-t:#cfd8e6;--ink:#eaf0f9;--line:#5c6b82}
body{background:var(--bg);color:var(--ink);font-family:system-ui,sans-serif}
.panel{background:var(--panel);border-radius:.5rem;padding:1rem}
.card{background:var(--card);border-radius:.5rem;padding:.75rem 1rem}
.inp{width:100%;background:var(--card);border:1px solid var(--line);border-radius:.375rem;padding:.45rem .7rem;color:var(--ink)}
.btn{background:var(--side);color:var(--side-t);border-radius:.375rem;padding:.45rem 1rem;font-weight:600}
.btn:focus-visible,.inp:focus-visible,a:focus-visible{outline:2px solid var(--ink);outline-offset:2px}
.badge{border-radius:.25rem;padding:.1rem .6rem;font-size:.75rem;color:#fff}
</style>
<script>if(localStorage.theme==='dark')document.documentElement.classList.add('dark')</script>
</head>
<body class="min-h-screen">
@auth
<div class="flex min-h-screen">
  <aside class="w-52 shrink-0 p-4 flex flex-col gap-1" style="background:var(--side);color:var(--side-t)">
    <div class="font-bold mb-4">Sentimen e-Samsat</div>
    @php $nav=[['dashboard','Dashboard','dashboard'],['analysis','Analisis Data','analisis*']]; if(auth()->user()->role==='admin')$nav[]=['pengguna.index','Master Pengguna','pengguna*']; @endphp
    @foreach($nav as [$r,$t,$p])
      <a href="{{ route($r) }}" class="rounded px-3 py-2 {{ request()->is($p==='dashboard'?'dashboard':$p)?'bg-white/20 font-semibold':'hover:bg-white/10' }}">{{ $t }}</a>
    @endforeach
    <div class="mt-auto flex flex-col gap-2 text-sm">
      <button type="button" id="theme" class="text-left px-3 py-2 rounded hover:bg-white/10">Ganti tema</button>
      <form method="POST" action="{{ route('logout') }}">@csrf<button class="text-left px-3 py-2 rounded hover:bg-white/10 w-full">Keluar ({{ auth()->user()->name }})</button></form>
    </div>
  </aside>
  <main class="flex-1 p-6">
    @if(session('ok'))<div class="card mb-4" role="status">{{ session('ok') }}</div>@endif
    @yield('content')
  </main>
</div>
<script>document.getElementById('theme').onclick=()=>{const d=document.documentElement.classList.toggle('dark');localStorage.theme=d?'dark':'light'}</script>
@else
@yield('content')
@endauth
@stack('scripts')
</body>
</html>
