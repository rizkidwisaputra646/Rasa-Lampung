<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rasa Lampung — Kuliner & Oleh-Oleh Khas Lampung')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-rasa-lampung.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-[#FAFAF5] text-[#1C1917] antialiased">
    <header class="sticky top-0 z-40 border-b border-stone-200/80 bg-[#FAFAF5]/90 backdrop-blur-md">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-18 items-center justify-between gap-4">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo-rasa-lampung.png') }}"
                         alt="Logo Rasa Lampung"
                         class="h-12 w-auto rounded-xl border border-stone-200/80 bg-white px-2 py-1 object-contain shadow-xs transition-transform group-hover:scale-[1.02]">
                    <div class="hidden sm:block">
                        <span class="block font-heading text-lg font-extrabold tracking-tight text-[#1C1917]">Rasa Lampung</span>
                        <span class="block text-[11px] font-medium uppercase tracking-widest text-[#D97706]">Kuliner &amp; Oleh-Oleh</span>
                    </div>
                </a>

                <nav class="hidden md:flex items-center gap-1" aria-label="Navigasi Utama">
                    <a href="{{ route('home') }}"
                       class="rounded-xl px-4 py-2 text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'bg-[#166534] text-white' : 'text-stone-700 hover:bg-stone-200/60 hover:text-[#1C1917]' }}">
                        Beranda
                    </a>
                    <a href="{{ route('products.index') }}"
                       class="rounded-xl px-4 py-2 text-sm font-medium transition-colors {{ request()->routeIs('products.*') ? 'bg-[#166534] text-white' : 'text-stone-700 hover:bg-stone-200/60 hover:text-[#1C1917]' }}">
                        Produk
                    </a>
                    <a href="{{ route('about') }}"
                       class="rounded-xl px-4 py-2 text-sm font-medium transition-colors {{ request()->routeIs('about') ? 'bg-[#166534] text-white' : 'text-stone-700 hover:bg-stone-200/60 hover:text-[#1C1917]' }}">
                        Tentang Kami
                    </a>
                </nav>

                <div class="hidden md:flex items-center gap-3">
                    @auth
                        <a href="{{ route('admin.dashboard') }}"
                           class="inline-flex items-center gap-2 rounded-xl border border-[#166534]/20 bg-white px-4 py-2 text-sm font-semibold text-[#166534] shadow-xs transition hover:border-[#166534] hover:bg-[#166534] hover:text-white">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center gap-2 rounded-xl border border-stone-300 bg-white px-4 py-2 text-sm font-medium text-stone-700 transition hover:border-[#166534] hover:text-[#166534]">
                            Login
                        </a>
                    @endauth
                </div>

                <button type="button"
                        id="mobile-menu-toggle"
                        class="inline-flex items-center justify-center rounded-xl border border-stone-300 bg-white p-2 text-stone-700 md:hidden hover:bg-stone-100"
                        aria-expanded="false"
                        aria-controls="mobile-menu"
                        aria-label="Buka menu navigasi">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <div id="mobile-menu" class="hidden border-t border-stone-200 py-4 md:hidden">
                <div class="flex flex-col gap-1.5">
                    <a href="{{ route('home') }}"
                       class="rounded-xl px-4 py-2.5 text-sm font-medium {{ request()->routeIs('home') ? 'bg-[#166534] text-white' : 'text-stone-700 hover:bg-stone-200/60' }}">
                        Beranda
                    </a>
                    <a href="{{ route('products.index') }}"
                       class="rounded-xl px-4 py-2.5 text-sm font-medium {{ request()->routeIs('products.*') ? 'bg-[#166534] text-white' : 'text-stone-700 hover:bg-stone-200/60' }}">
                        Produk
                    </a>
                    <a href="{{ route('about') }}"
                       class="rounded-xl px-4 py-2.5 text-sm font-medium {{ request()->routeIs('about') ? 'bg-[#166534] text-white' : 'text-stone-700 hover:bg-stone-200/60' }}">
                        Tentang Kami
                    </a>
                    <div class="pt-2 mt-2 border-t border-stone-200">
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="block rounded-xl bg-white border border-[#166534]/20 px-4 py-2.5 text-sm font-semibold text-[#166534]">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="block rounded-xl bg-white border border-stone-300 px-4 py-2.5 text-sm font-medium text-stone-700">
                                Login
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="mt-20 border-t border-stone-200 bg-[#14532D] text-stone-100">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
            <div class="grid gap-10 md:grid-cols-3">
                <div>
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-rasa-lampung.png') }}"
                             alt="Logo Rasa Lampung"
                             class="h-14 w-auto rounded-2xl bg-white px-2.5 py-1.5 object-contain shadow-xs">
                        <div>
                            <h2 class="font-heading text-lg font-bold text-white">Rasa Lampung</h2>
                            <p class="text-xs text-emerald-200">UMKM Kuliner &amp; Oleh-Oleh Khas Lampung</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm leading-relaxed text-emerald-100/85">
                        Menghadirkan kekayaan rasa tanah Lampung melalui produk kopi pilihan, camilan renyah, sambal rumahan, dan oleh-oleh berkualitas untuk keluarga Indonesia.
                    </p>
                </div>

                <div>
                    <h3 class="font-heading text-sm font-bold uppercase tracking-wider text-amber-300">Navigasi</h3>
                    <ul class="mt-4 space-y-2.5 text-sm text-emerald-100/90">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition-colors">Katalog Produk</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Login</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-heading text-sm font-bold uppercase tracking-wider text-amber-300">Informasi Usaha</h3>
                    <ul class="mt-4 space-y-2.5 text-sm text-emerald-100/90">
                        <li>Jl. Raden Intan No. 88, Tanjung Karang, Bandar Lampung</li>
                        <li>Buka Setiap Hari: 08.00 – 21.00 WIB</li>
                        <li>Email: halo@rasalampung.id</li>
                        <li>Telepon / WhatsApp: (0721) 555-0188</li>
                    </ul>
                </div>
            </div>

            <div class="mt-10 border-t border-emerald-800/80 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-emerald-200/80">
                <p>&copy; {{ date('Y') }} Rasa Lampung. Katalog Digital UMKM Khas Lampung.</p>
                <p>Dibuat dengan cita rasa lokal Sai Bumi Ruwa Jurai.</p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', String(!expanded));
            menu?.classList.toggle('hidden');
        });
    </script>
</body>
</html>
