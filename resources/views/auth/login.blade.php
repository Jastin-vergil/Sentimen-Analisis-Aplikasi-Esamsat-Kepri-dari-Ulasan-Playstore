@extends('layouts.app')
@section('title','Masuk')
@section('content')
<div class="min-h-screen grid place-items-center p-4">
  <form method="POST" action="{{ route('login') }}" class="panel w-full max-w-sm space-y-3">
    @csrf
    <h1 class="text-center font-bold">Sentimen Analisis e-Samsat</h1>
    <h2 class="text-center text-sm">Masuk</h2>
    <div><label for="email" class="text-sm">Email</label>
      <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="inp" style="{{ $errors->has('email')?'border-color:var(--neg)':'' }}"></div>
    <div><label for="password" class="text-sm">Kata sandi</label>
      <input id="password" name="password" type="password" required class="inp"></div>
    @error('email')<p class="text-sm font-semibold" style="color:var(--neg)" role="alert">{{ $message }}</p>@enderror
    <button class="btn w-full">Masuk</button>
  </form>
</div>
@endsection
