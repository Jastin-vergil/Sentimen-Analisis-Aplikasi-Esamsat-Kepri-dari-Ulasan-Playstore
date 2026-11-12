@extends('layouts.app')
@section('title','Master Pengguna')
@section('content')
<div class="flex items-center justify-between mb-4"><h1 class="text-xl font-bold">Master Pengguna</h1><a href="{{ route('pengguna.create') }}" class="btn">Tambah pengguna</a></div>
<form method="GET" class="flex gap-2 mb-4">
  <input name="q" value="{{ request('q') }}" placeholder="Cari nama atau email" class="inp" aria-label="Cari pengguna">
  <select name="role" class="inp !w-44" aria-label="Filter peran"><option value="">Semua peran</option>
    @foreach(['admin','peneliti'] as $r)<option value="{{ $r }}" @selected(request('role')===$r)>{{ ucfirst($r) }}</option>@endforeach</select>
  <button class="btn">Cari</button>
</form>
<div class="panel space-y-2">
@forelse($users as $u)
  <div class="card flex items-center gap-3">
    <div class="flex-1"><div class="font-semibold">{{ $u->name }}</div><div class="text-sm opacity-80">{{ $u->email }}</div></div>
    <span class="badge" style="background:{{ $u->role==='admin'?'var(--neg)':'var(--pos)' }}">{{ ucfirst($u->role) }}</span>
    <a href="{{ route('pengguna.edit',$u) }}" class="underline text-sm">Ubah</a>
    @if($u->id!==auth()->id())
    <form method="POST" action="{{ route('pengguna.destroy',$u) }}" onsubmit="return confirm('Hapus {{ $u->name }}?')">@csrf @method('DELETE')<button class="underline text-sm">Hapus</button></form>@endif
  </div>
@empty
  <div class="card text-center py-10"><div class="text-4xl">?</div><p class="font-semibold">Tidak ada hasil</p><p class="text-sm">Ubah kata kunci atau hapus filter peran.</p></div>
@endforelse
</div>
@endsection
