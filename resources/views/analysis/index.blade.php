@extends('layouts.app')
@section('title','Analisis Data')
@section('content')
<h1 class="text-xl font-bold mb-4">Analisis Data</h1>
<section class="panel max-w-3xl space-y-3">
  <label for="text" class="text-sm">Teks ulasan</label>
  <textarea id="text" rows="5" maxlength="2000" class="inp" placeholder="Tempel ulasan pengguna aplikasi e-Samsat Kepri..."></textarea>
  <div class="flex gap-2"><button id="go" class="btn">Analisis</button><button id="reset" type="button" class="btn !bg-transparent !text-[color:var(--ink)] border" style="border-color:var(--line)">Bersihkan</button></div>
  <div id="out" aria-live="polite"></div>
</section>
@endsection
@push('scripts')
<script>
const $=id=>document.getElementById(id), tok=document.querySelector('meta[name=csrf-token]').content;
const col={positif:'var(--pos)',netral:'var(--neu)',negatif:'var(--neg)'};
const show=h=>$('out').innerHTML=h;
const err=m=>show(`<div class="card text-center py-6"><div class="text-3xl">!</div><p class="font-semibold">Terjadi kesalahan</p><p class="text-sm">${m}</p></div>`);
$('reset').onclick=()=>{$('text').value='';show('')};
$('go').onclick=async()=>{
  const text=$('text').value.trim(); if(text.length<5)return err('Tulis minimal 5 karakter.');
  $('go').disabled=true; show('<div class="card text-center py-6" role="status">Sedang memuat data...</div>');
  try{
    const r=await fetch('{{ route('analysis.store') }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':tok,'Accept':'application/json'},body:JSON.stringify({text})});
    if(!r.ok)throw 0; const {id}=await r.json();
    for(let i=0;i<40;i++){ // ±60 detik
      await new Promise(s=>setTimeout(s,1500));
      const s=await (await fetch(`/analisis/${id}/status`,{headers:{'Accept':'application/json'}})).json();
      if(s.status==='done'){
        show(`<div class="card space-y-2"><div>Hasil: <span class="badge" style="background:${col[s.label]}">${s.label}</span></div>
        <div class="text-sm">Keyakinan model: ${s.confidence}%</div>
        <div class="h-2 rounded bg-black/20"><div class="h-2 rounded" style="width:${s.confidence}%;background:${col[s.label]}"></div></div></div>`);
        return;
      }
      if(s.status==='failed')throw 0;
    }
    err('Layanan analisis belum merespons. Pastikan worker Python berjalan, lalu coba lagi.');
  }catch(e){err('Data tidak dapat diproses. Periksa koneksi atau worker Python, lalu coba lagi.')}
  finally{$('go').disabled=false}
};
</script>
@endpush
