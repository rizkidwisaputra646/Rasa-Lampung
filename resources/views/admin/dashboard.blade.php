@extends('layouts.admin')

@section('title', 'Dashboard Admin — Rasa Lampung')
@section('page_title', 'Dashboard Ringkasan')

@section('content')
    {{-- Stat Cards --}}
    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-xs">
            <span class="text-xs font-semibold uppercase tracking-wider text-stone-400">Total Produk</span>
            <p class="mt-2 font-heading text-3xl font-extrabold text-[#166534]">{{ $totalProducts }}</p>
            <p class="mt-1 text-xs text-stone-500">Produk terdaftar di katalog</p>
        </div>

        <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-xs">
            <span class="text-xs font-semibold uppercase tracking-wider text-stone-400">Total Kategori</span>
            <p class="mt-2 font-heading text-3xl font-extrabold text-[#166534]">{{ $totalCategories }}</p>
            <p class="mt-1 text-xs text-stone-500">Kategori produk aktif</p>
        </div>

        <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-xs">
            <span class="text-xs font-semibold uppercase tracking-wider text-stone-400">Produk Tersedia</span>
            <p class="mt-2 font-heading text-3xl font-extrabold text-[#D97706]">{{ $availableProducts }}</p>
            <p class="mt-1 text-xs text-stone-500">Siap tampil &amp; tersedia</p>
        </div>

        <div class="rounded-2xl border border-stone-200 bg-white p-6 shadow-xs">
            <span class="text-xs font-semibold uppercase tracking-wider text-stone-400">Produk Terbaru</span>
            <p class="mt-2 font-heading text-lg font-extrabold text-[#1C1917] line-clamp-1">
                {{ $latestProduct?->name ?? 'Belum ada produk' }}
            </p>
            <p class="mt-1 text-xs text-stone-500">
                {{ $latestProduct ? $latestProduct->created_at->diffForHumans() : 'Tambahkan produk pertama Anda' }}
            </p>
        </div>
    </div>

    <div class="mt-8 grid gap-8 lg:grid-cols-12">
        {{-- Recent Products Table --}}
        <div class="lg:col-span-8 rounded-3xl border border-stone-200 bg-white shadow-xs overflow-hidden">
            <div class="flex items-center justify-between border-b border-stone-200 px-6 py-5">
                <div>
                    <h2 class="font-heading text-lg font-bold text-[#1C1917]">Daftar Produk Terbaru</h2>
                    <p class="text-xs text-stone-500">5 produk yang terakhir ditambahkan ke katalog.</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="text-sm font-semibold text-[#166534] hover:underline">
                    Kelola Semua &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-stone-200 text-sm">
                    <thead class="bg-[#FAFAF5] text-left text-xs font-semibold uppercase tracking-wider text-stone-500">
                        <tr>
                            <th class="px-6 py-3.5">Produk</th>
                            <th class="px-6 py-3.5">Kategori</th>
                            <th class="px-6 py-3.5">Harga</th>
                            <th class="px-6 py-3.5">Status</th>
                            <th class="px-6 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @forelse ($recentProducts as $product)
                            <tr class="hover:bg-stone-50/80">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if ($product->image_url)
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-11 w-11 rounded-xl object-cover border border-stone-200">
                                        @else
                                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-xs font-bold text-[#166534]">RL</div>
                                        @endif
                                        <span class="font-semibold text-[#1C1917]">{{ $product->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-stone-600">{{ $product->category?->name ?? '-' }}</td>
                                <td class="px-6 py-4 font-semibold text-[#166534]">{{ $product->formatted_price }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $product->isAvailable() ? 'bg-emerald-50 text-[#166534]' : 'bg-stone-100 text-stone-600' }}">
                                        {{ $product->isAvailable() ? 'Tersedia' : 'Habis' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="font-semibold text-[#D97706] hover:underline">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-stone-500">
                                    Belum ada produk di database.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Category Breakdown --}}
        <div class="lg:col-span-4 rounded-3xl border border-stone-200 bg-white p-6 shadow-xs">
            <div class="flex items-center justify-between">
                <h2 class="font-heading text-lg font-bold text-[#1C1917]">Distribusi Kategori</h2>
                <a href="{{ route('admin.categories.index') }}" class="text-xs font-semibold text-[#166534] hover:underline">Kelola</a>
            </div>
            <div class="mt-5 space-y-3">
                @forelse ($categoriesSummary as $category)
                    <div class="flex items-center justify-between rounded-2xl bg-[#FAFAF5] px-4 py-3 border border-stone-200/70">
                        <span class="text-sm font-medium text-[#1C1917]">{{ $category->name }}</span>
                        <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-[#166534] border border-stone-200">
                            {{ $category->products_count }}
                        </span>
                    </div>
                @empty
                    <p class="text-sm text-stone-500">Belum ada kategori.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
