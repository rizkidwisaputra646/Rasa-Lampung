@extends('layouts.public')

@section('title', $product->name.' — Rasa Lampung')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <nav class="mb-8 flex flex-wrap items-center gap-2 text-xs font-medium text-stone-500" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#166534]">Beranda</a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-[#166534]">Produk</a>
            @if ($product->category)
                <span>/</span>
                <a href="{{ route('products.index', ['kategori' => $product->category->slug]) }}" class="hover:text-[#166534]">
                    {{ $product->category->name }}
                </a>
            @endif
            <span>/</span>
            <span class="text-[#1C1917] font-semibold">{{ $product->name }}</span>
        </nav>

        <div class="grid gap-10 lg:grid-cols-12 items-start">
            <div class="lg:col-span-6">
                <div class="overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm">
                    @if ($product->image_url)
                        <img src="{{ $product->image_url }}"
                             alt="{{ $product->name }}"
                             class="aspect-[4/3] w-full object-cover">
                    @else
                        <div class="flex aspect-[4/3] w-full flex-col items-center justify-center bg-gradient-to-br from-emerald-50 to-amber-50 p-10 text-center">
                            <svg class="h-16 w-16 text-[#166534]/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                            </svg>
                            <span class="mt-3 text-sm font-medium text-stone-500">Foto produk belum tersedia</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-6">
                <div class="rounded-3xl border border-stone-200 bg-white p-6 sm:p-8 shadow-xs">
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('products.index', ['kategori' => $product->category?->slug]) }}"
                           class="inline-flex items-center rounded-full border border-amber-200 bg-amber-50 px-3.5 py-1 text-xs font-semibold text-[#D97706] hover:bg-amber-100">
                            {{ $product->category?->name ?? 'Kategori Umum' }}
                        </a>
                        <span class="inline-flex items-center gap-1.5 rounded-full px-3.5 py-1 text-xs font-semibold {{ $product->isAvailable() ? 'bg-emerald-50 text-[#166534] border border-emerald-200' : 'bg-stone-100 text-stone-700 border border-stone-300' }}">
                            <span class="h-2 w-2 rounded-full {{ $product->isAvailable() ? 'bg-[#166534]' : 'bg-stone-500' }}"></span>
                            {{ $product->isAvailable() ? 'Tersedia' : 'Stok Habis' }}
                        </span>
                    </div>

                    <h1 class="mt-4 font-heading text-3xl font-extrabold text-[#1C1917] sm:text-4xl">
                        {{ $product->name }}
                    </h1>

                    <div class="mt-5 border-y border-stone-100 py-5">
                        <span class="block text-xs font-medium uppercase tracking-wider text-stone-400">Harga Produk</span>
                        <p class="mt-1 font-heading text-3xl font-extrabold text-[#166534]">
                            {{ $product->formatted_price }}
                        </p>
                    </div>

                    <div class="mt-6">
                        <h2 class="font-heading text-sm font-bold uppercase tracking-wider text-stone-500">Deskripsi Lengkap</h2>
                        <div class="mt-3 text-base leading-relaxed text-stone-700 whitespace-pre-line">{{ $product->description }}</div>
                    </div>

                    <div class="mt-8 rounded-2xl bg-[#FAFAF5] p-5 border border-stone-200/80">
                        <p class="text-xs font-semibold uppercase tracking-wider text-[#D97706]">Informasi Pembelian</p>
                        <p class="mt-1.5 text-sm text-stone-600">
                            Kunjungi gerai Rasa Lampung di Jl. Raden Intan No. 88, Bandar Lampung atau hubungi (0721) 555-0188 untuk pemesanan langsung.
                        </p>
                    </div>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center gap-2 rounded-xl border border-stone-300 bg-white px-5 py-3 text-sm font-semibold text-stone-700 transition hover:border-[#166534] hover:text-[#166534]">
                            &larr; Kembali ke Katalog
                        </a>
                        <a href="{{ route('about') }}"
                           class="inline-flex items-center gap-2 rounded-xl bg-[#166534] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#14532D]">
                            Info Lokasi &amp; Kontak
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if ($relatedProducts->isNotEmpty())
            <div class="mt-16 border-t border-stone-200 pt-12">
                <div class="flex items-center justify-between gap-4">
                    <h2 class="font-heading text-2xl font-extrabold text-[#1C1917]">Produk Lainnya di {{ $product->category?->name }}</h2>
                    <a href="{{ route('products.index', ['kategori' => $product->category?->slug]) }}" class="text-sm font-semibold text-[#166534] hover:underline">
                        Lihat Semua &rarr;
                    </a>
                </div>
                <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($relatedProducts as $related)
                        <x-product-card :product="$related" />
                    @endforeach
                </div>
            </div>
        @endif
    </section>
@endsection
