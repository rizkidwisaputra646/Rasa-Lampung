@extends('layouts.public')

@section('title', 'Katalog Produk — Rasa Lampung')

@section('content')
    <section class="border-b border-stone-200/80 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <span class="text-xs font-bold uppercase tracking-widest text-[#D97706]">Katalog Digital UMKM</span>
                <h1 class="mt-2 font-heading text-3xl font-extrabold text-[#1C1917] sm:text-4xl">
                    {{ $activeCategory ? $activeCategory->name : 'Seluruh Produk Rasa Lampung' }}
                </h1>
                <p class="mt-3 text-base text-stone-600">
                    {{ $activeCategory?->description ?? 'Temukan seluruh koleksi makanan, minuman, kopi, sambal, dan oleh-oleh khas Lampung.' }}
                </p>
            </div>

            <form method="GET" action="{{ route('products.index') }}" class="mt-8 flex flex-col gap-3 sm:flex-row">
                @if ($selectedCategorySlug !== '')
                    <input type="hidden" name="kategori" value="{{ $selectedCategorySlug }}">
                @endif
                <div class="relative flex-1">
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-stone-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                        </svg>
                    </span>
                    <input type="text"
                           name="cari"
                           value="{{ $search }}"
                           placeholder="Cari nama produk, misalnya Kopi Robusta atau Keripik Pisang..."
                           class="w-full rounded-2xl border border-stone-300 bg-[#FAFAF5] py-3 pl-12 pr-4 text-sm text-[#1C1917] placeholder:text-stone-400 focus:border-[#166534] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#166534]/20">
                </div>
                <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-[#166534] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#14532D]">
                    Cari Produk
                </button>
                @if ($search !== '' || $selectedCategorySlug !== '')
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center justify-center rounded-2xl border border-stone-300 bg-white px-5 py-3 text-sm font-medium text-stone-700 transition hover:bg-stone-100">
                        Reset
                    </a>
                @endif
            </form>

            <div class="mt-6 flex flex-wrap items-center gap-2">
                <a href="{{ route('products.index', array_filter(['cari' => $search])) }}"
                   class="rounded-full px-4 py-2 text-xs font-semibold transition {{ $selectedCategorySlug === '' ? 'bg-[#166534] text-white' : 'border border-stone-200 bg-[#FAFAF5] text-stone-700 hover:border-[#166534] hover:text-[#166534]' }}">
                    Semua Kategori
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('products.index', array_filter(['kategori' => $category->slug, 'cari' => $search])) }}"
                       class="rounded-full px-4 py-2 text-xs font-semibold transition {{ $selectedCategorySlug === $category->slug ? 'bg-[#166534] text-white' : 'border border-stone-200 bg-[#FAFAF5] text-stone-700 hover:border-[#166534] hover:text-[#166534]' }}">
                        {{ $category->name }} ({{ $category->products_count }})
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between text-sm text-stone-600">
            <p>
                Menampilkan <span class="font-semibold text-[#1C1917]">{{ $products->count() }}</span> dari
                <span class="font-semibold text-[#1C1917]">{{ $products->total() }}</span> produk
                @if ($search !== '')
                    untuk kata kunci "<span class="font-semibold text-[#166534]">{{ $search }}</span>"
                @endif
            </p>
        </div>

        @if ($products->isNotEmpty())
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @else
            <div class="rounded-3xl border border-dashed border-stone-300 bg-white px-6 py-16 text-center">
                <h2 class="font-heading text-xl font-bold text-[#1C1917]">Produk tidak ditemukan</h2>
                <p class="mt-2 text-sm text-stone-600">
                    Coba gunakan kata kunci lain atau lihat seluruh kategori produk yang tersedia.
                </p>
                <a href="{{ route('products.index') }}"
                   class="mt-6 inline-flex items-center rounded-xl bg-[#166534] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#14532D]">
                    Tampilkan Semua Produk
                </a>
            </div>
        @endif
    </section>
@endsection
