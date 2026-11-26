@extends('layouts.public')

@section('title', 'Rasa Lampung — Kuliner & Oleh-Oleh Khas Lampung')

@section('content')
    {{-- Hero Section --}}
    <section class="relative overflow-hidden border-b border-stone-200/70 bg-gradient-to-br from-[#FAFAF5] via-emerald-50/40 to-amber-50/50">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
            <div class="grid items-center gap-12 lg:grid-cols-12">
                <div class="lg:col-span-7">
                    <span class="inline-flex items-center gap-2 rounded-full border border-[#D97706]/30 bg-amber-50 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-[#D97706]">
                        UMKM Kuliner &amp; Oleh-Oleh Asli Lampung
                    </span>

                    <h1 class="mt-6 font-heading text-4xl font-extrabold tracking-tight text-[#1C1917] sm:text-5xl lg:text-6xl leading-[1.1]">
                        Kenali Cita Rasa Khas Lampung
                    </h1>

                    <p class="mt-6 max-w-2xl text-base leading-relaxed text-stone-600 sm:text-lg">
                        Temukan berbagai pilihan kuliner dan oleh-oleh khas Lampung dengan cita rasa lokal yang istimewa. Mulai dari kopi robusta dataran tinggi, keripik pisang renyah, hingga sambal autentik warisan dapur Lampung.
                    </p>

                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center gap-2 rounded-2xl bg-[#166534] px-6 py-3.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#14532D]">
                            Jelajahi Katalog Produk
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                        <a href="{{ route('about') }}"
                           class="inline-flex items-center gap-2 rounded-2xl border border-stone-300 bg-white px-6 py-3.5 text-sm font-semibold text-[#1C1917] transition hover:border-[#166534] hover:text-[#166534]">
                            Tentang Usaha Kami
                        </a>
                    </div>

                    <div class="mt-10 grid grid-cols-3 gap-4 border-t border-stone-200/80 pt-8 max-w-lg">
                        <div>
                            <p class="font-heading text-2xl font-extrabold text-[#166534]">{{ $totalProducts }}+</p>
                            <p class="mt-0.5 text-xs text-stone-600">Produk Pilihan</p>
                        </div>
                        <div>
                            <p class="font-heading text-2xl font-extrabold text-[#166534]">{{ $totalCategories }}</p>
                            <p class="mt-0.5 text-xs text-stone-600">Kategori Khas</p>
                        </div>
                        <div>
                            <p class="font-heading text-2xl font-extrabold text-[#D97706]">100%</p>
                            <p class="mt-0.5 text-xs text-stone-600">Produk Lokal</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <div class="relative rounded-3xl border border-stone-200 bg-white p-6 shadow-xl">
                        <div class="mb-5 flex justify-center rounded-2xl border border-stone-100 bg-[#FAFAF5] p-4">
                            <img src="{{ asset('images/logo-rasa-lampung.png') }}"
                                 alt="Logo Rasa Lampung"
                                 class="h-32 w-auto object-contain">
                        </div>
                        <div class="rounded-2xl bg-[#14532D] p-7 text-white">
                            <p class="text-xs font-semibold uppercase tracking-widest text-amber-300">Sajian Pilihan</p>
                            <h2 class="mt-2 font-heading text-2xl font-bold leading-snug">
                                Rasa Otentik dari Tanah Sai Bumi Ruwa Jurai
                            </h2>
                            <p class="mt-3 text-sm leading-relaxed text-emerald-100/90">
                                Setiap produk Rasa Lampung diolah dari bahan baku lokal pilihan petani dan perajin UMKM Lampung dengan standar kebersihan dan kemasan modern.
                            </p>
                            <div class="mt-6 grid grid-cols-2 gap-3">
                                @foreach ($categories->take(4) as $cat)
                                    <a href="{{ route('products.index', ['kategori' => $cat->slug]) }}"
                                       class="rounded-xl bg-white/10 p-3 text-left transition hover:bg-white/20">
                                        <span class="block text-xs font-semibold text-amber-300">{{ $cat->products_count }} Produk</span>
                                        <span class="mt-1 block text-sm font-semibold text-white line-clamp-1">{{ $cat->name }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kategori Produk --}}
    <section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-[#D97706]">Kategori Pilihan</p>
                <h2 class="mt-2 font-heading text-3xl font-extrabold text-[#1C1917]">Telusuri Berdasarkan Kategori</h2>
            </div>
            <a href="{{ route('products.index') }}" class="text-sm font-semibold text-[#166534] hover:text-[#14532D]">
                Lihat Semua Produk &rarr;
            </a>
        </div>

        @if ($categories->isNotEmpty())
            <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($categories as $category)
                    <a href="{{ route('products.index', ['kategori' => $category->slug]) }}"
                       class="group flex flex-col justify-between rounded-2xl border border-stone-200 bg-white p-6 shadow-xs transition-all duration-300 hover:-translate-y-1 hover:border-[#166534]/40 hover:shadow-md">
                        <div>
                            <div class="flex items-center justify-between gap-2">
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-[#166534] font-heading font-bold">
                                    {{ strtoupper(substr($category->name, 0, 2)) }}
                                </span>
                                <span class="rounded-full bg-stone-100 px-3 py-1 text-xs font-semibold text-stone-600 group-hover:bg-emerald-50 group-hover:text-[#166534]">
                                    {{ $category->products_count }} produk
                                </span>
                            </div>
                            <h3 class="mt-5 font-heading text-lg font-bold text-[#1C1917] group-hover:text-[#166534]">
                                {{ $category->name }}
                            </h3>
                            <p class="mt-2 text-sm leading-relaxed text-stone-600 line-clamp-3">
                                {{ $category->description ?? 'Aneka produk unggulan dalam kategori '.$category->name.'.' }}
                            </p>
                        </div>
                        <span class="mt-5 inline-flex items-center gap-1 text-xs font-semibold text-[#D97706]">
                            Lihat kategori &rarr;
                        </span>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Produk Unggulan --}}
    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-[#D97706]">Katalog Terkini</p>
                <h2 class="mt-2 font-heading text-3xl font-extrabold text-[#1C1917]">Produk Unggulan Rasa Lampung</h2>
                <p class="mt-2 text-sm text-stone-600">Pilihan kuliner dan oleh-oleh favorit langsung dari database produk kami.</p>
            </div>
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center gap-2 rounded-xl border border-[#166534]/30 bg-white px-4 py-2.5 text-sm font-semibold text-[#166534] transition hover:bg-[#166534] hover:text-white">
                Semua Produk
            </a>
        </div>

        @if ($featuredProducts->isNotEmpty())
            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @else
            <div class="mt-8 rounded-2xl border border-dashed border-stone-300 bg-white p-12 text-center">
                <p class="text-stone-600">Belum ada produk yang tersedia saat ini.</p>
            </div>
        @endif
    </section>

    {{-- Section Tentang Usaha --}}
    <section class="mx-auto max-w-7xl px-4 pt-14 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm">
            <div class="grid items-center lg:grid-cols-12">
                <div class="bg-[#166534] p-8 sm:p-12 text-white lg:col-span-5 h-full flex flex-col justify-center">
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-300">Tentang Usaha</span>
                    <h2 class="mt-3 font-heading text-3xl font-extrabold leading-tight">
                        Menjaga Warisan Kuliner Lokal Lampung
                    </h2>
                    <p class="mt-4 text-sm leading-relaxed text-emerald-100/90">
                        Rasa Lampung hadir sebagai mitra UMKM kuliner lokal untuk memperkenalkan kelezatan otentik daerah kepada masyarakat luas secara digital dan transparan.
                    </p>
                </div>
                <div class="p-8 sm:p-12 lg:col-span-7">
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div class="rounded-2xl bg-[#FAFAF5] p-5 border border-stone-200/70">
                            <h3 class="font-heading text-base font-bold text-[#1C1917]">Bahan Baku Pilihan</h3>
                            <p class="mt-2 text-sm text-stone-600">Dipilih langsung dari petani kopi, pisang, dan rempah terbaik di wilayah Lampung.</p>
                        </div>
                        <div class="rounded-2xl bg-[#FAFAF5] p-5 border border-stone-200/70">
                            <h3 class="font-heading text-base font-bold text-[#1C1917]">Kemasan Modern &amp; Higienis</h3>
                            <p class="mt-2 text-sm text-stone-600">Dikemas rapi agar kualitas rasa tetap terjaga dan siap dijadikan oleh-oleh istimewa.</p>
                        </div>
                    </div>
                    <div class="mt-8 flex flex-wrap items-center justify-between gap-4">
                        <p class="text-sm text-stone-600">Ingin mengenal perjalanan, visi, dan lokasi toko kami?</p>
                        <a href="{{ route('about') }}"
                           class="inline-flex items-center gap-2 rounded-xl bg-[#D97706] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-amber-700">
                            Baca Profil Lengkap &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
