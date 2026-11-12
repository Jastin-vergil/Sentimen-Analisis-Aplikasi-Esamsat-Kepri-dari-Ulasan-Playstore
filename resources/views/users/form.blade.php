@extends('layouts.app')
@section('title',$user->exists?'Ubah pengguna':'Tambah pengguna')
@section('content')
<h1 class="text-xl font-bold mb-4">{{ $user->exists?'Ubah pengguna':'Tambah pengguna' }}</h1>
<form method="POST" action="{{ $user->exists?route('pengguna.update',$user):route('pengguna.store') }}" class="panel max-w-md space-y-3">
  @csrf @if($user->exists) @method('PUT') @endif
  @foreach([['name','Nama','text'],['email','Email','email'],['password',$user->exists?'Kata sandi baru (opsional)':'Kata sandi','password']] as [$n,$l,$ty])
  <div><label for="{{ $n }}" class="text-sm">{{ $l }}</label><input id="{{ $n }}" name="{{ $n }}" type="{{ $ty }}" value="{{ $ty==='password'?'':old($n,$user->$n) }}" class="inp">@error($n)<p class="text-sm" style="color:var(--neg)">{{ $message }}</p>@enderror</div>
  @endforeach
  <div><label for="role" class="text-sm">Peran</label><select id="role" name="role" class="inp">@foreach(['peneliti','admin'] as $r)<option value="{{ $r }}" @selected(old('role',$user->role)===$r)>{{ ucfirst($r) }}</option>@endforeach</select></div>
  <div class="flex gap-2"><button class="btn">Simpan</button><a href="{{ route('pengguna.index') }}" class="btn !bg-transparent !text-[color:var(--ink)] border" style="border-color:var(--line)">Batal</a></div>
</form>
@endsection
