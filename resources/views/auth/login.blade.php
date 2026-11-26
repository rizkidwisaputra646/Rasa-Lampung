<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator — Rasa Lampung</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-rasa-lampung.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#FAFAF5] text-[#1C1917] antialiased flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <a href="{{ route('home') }}" class="inline-flex flex-col items-center gap-2">
                <img src="{{ asset('images/logo-rasa-lampung.png') }}"
                     alt="Logo Rasa Lampung"
                     class="h-24 w-auto rounded-2xl border border-stone-200 bg-white px-4 py-2 object-contain shadow-xs">
                <span class="block text-xs font-semibold uppercase tracking-wider text-[#D97706]">Portal Administrator</span>
            </a>
        </div>

        <div class="rounded-3xl border border-stone-200 bg-white p-8 shadow-sm">
            <h1 class="font-heading text-2xl font-extrabold text-[#1C1917]">Masuk ke Dashboard</h1>
            <p class="mt-2 text-sm text-stone-600">
                Silakan masuk menggunakan akun administrator untuk mengelola katalog produk dan kategori.
            </p>

            @if (session('success'))
                <div class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-[#166534]">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.attempt') }}" class="mt-6 space-y-5" novalidate>
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-[#1C1917]">Email</label>
                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           placeholder="admin@rasalampung.test"
                           class="mt-2 w-full rounded-xl border px-4 py-3 text-sm text-[#1C1917] transition focus:outline-none focus:ring-2 {{ $errors->has('email') ? 'border-red-400 bg-red-50/40 focus:border-red-500 focus:ring-red-200' : 'border-stone-300 bg-[#FAFAF5] focus:border-[#166534] focus:bg-white focus:ring-[#166534]/20' }}">
                    @error('email')
                        <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-[#1C1917]">Password</label>
                    <input id="password"
                           type="password"
                           name="password"
                           required
                           placeholder="Masukkan password administrator"
                           class="mt-2 w-full rounded-xl border px-4 py-3 text-sm text-[#1C1917] transition focus:outline-none focus:ring-2 {{ $errors->has('password') ? 'border-red-400 bg-red-50/40 focus:border-red-500 focus:ring-red-200' : 'border-stone-300 bg-[#FAFAF5] focus:border-[#166534] focus:bg-white focus:ring-[#166534]/20' }}">
                    @error('password')
                        <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 text-sm text-stone-600">
                        <input type="checkbox" name="remember" value="1" class="rounded border-stone-300 text-[#166534] focus:ring-[#166534]">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button type="submit"
                        class="w-full rounded-xl bg-[#166534] px-5 py-3.5 text-sm font-semibold text-white shadow-xs transition hover:bg-[#14532D] focus:outline-none focus:ring-2 focus:ring-[#166534]/40">
                    Masuk Dashboard
                </button>
            </form>
        </div>

        <p class="mt-6 text-center text-sm text-stone-600">
            <a href="{{ route('home') }}" class="font-medium text-[#166534] hover:underline">
                &larr; Kembali ke Website Publik Rasa Lampung
            </a>
        </p>
    </div>
</body>
</html>
