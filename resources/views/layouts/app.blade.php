<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik App - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen">

    <nav class="bg-gradient-to-r from-indigo-900 to-slate-900 text-white px-6 py-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">

            <span class="font-bold text-lg">Klinik App</span>

            @if (auth()->check())
                <div class="flex items-center gap-6 text-sm">
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('pasien.index') }}"
                            class="{{ request()->routeIs('pasien.*') ? 'underline font-semibold text-indigo-200' : 'hover:underline' }}">Data
                            Pasien</a>
                        <a href="{{ route('jadwal.checker') }}"
                            class="{{ request()->routeIs('jadwal.checker') ? 'underline font-semibold text-indigo-200' : 'hover:underline' }}">Jadwal
                            Checker</a>
                    @endif
                    @if (auth()->user()->role === 'pasien')
                        <a href="{{ route('jadwal.index') }}"
                            class="{{ request()->routeIs('jadwal.*') ? 'underline font-semibold text-indigo-200' : 'hover:underline' }}">Jadwal</a>
                        <a href="{{ route('rekam_medis.riwayat') }}"
                            class="{{ request()->routeIs('rekam_medis.riwayat') ? 'underline font-semibold text-indigo-200' : 'hover:underline' }}">Riwayat
                            Pemeriksaan</a>
                    @endif
                    @if (auth()->user()->role === 'dokter')
                        <a href="{{ route('rekam_medis.index') }}"
                            class="{{ request()->routeIs('rekam_medis.*') ? 'underline font-semibold text-indigo-200' : 'hover:underline' }}">Rekam
                            Medis</a>
                    @endif


                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-red-600 px-3 py-1 rounded hover:bg-red-700 transition font-semibold">Logout</button>
                    </form>
                </div>
            @endif
        </div>
    </nav>

    <main class="max-w-6xl mx-auto p-6">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

</body>

</html>
