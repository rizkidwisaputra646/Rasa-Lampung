@extends('layouts.admin')

@section('title', 'Manajemen Produk — Rasa Lampung')
@section('page_title', 'Manajemen Produk')

@section('content')
    <div class="rounded-3xl border border-stone-200 bg-white shadow-xs overflow-hidden">
        <div class="border-b border-stone-200 p-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="font-heading text-xl font-bold text-[#1C1917]">Daftar Produk</h2>
                <p class="mt-1 text-sm text-stone-500">Kelola seluruh data produk, foto, harga, dan status ketersediaan.</p>
            </div>

            <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-wrap items-center gap-2.5">
                <input type="text"
                       name="cari"
                       value="{{ $search }}"
                       placeholder="Cari nama produk..."
                       class="rounded-xl border border-stone-300 bg-[#FAFAF5] px-3.5 py-2 text-sm focus:border-[#166534] focus:bg-white focus:outline-none">
                <select name="category_id"
                        class="rounded-xl border border-stone-300 bg-[#FAFAF5] px-3.5 py-2 text-sm focus:border-[#166534] focus:bg-white focus:outline-none">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) $categoryId === (string) $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-xl bg-[#14532D] px-4 py-2 text-sm font-semibold text-white hover:bg-[#166534]">
                    Filter
                </button>
                @if ($search !== '' || $categoryId)
                    <a href="{{ route('admin.products.index') }}" class="rounded-xl border border-stone-300 px-3.5 py-2 text-sm text-stone-600 hover:bg-stone-100">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-stone-200 text-sm">
                <thead class="bg-[#FAFAF5] text-left text-xs font-semibold uppercase tracking-wider text-stone-500">
                    <tr>
                        <th class="px-6 py-3.5">Foto</th>
                        <th class="px-6 py-3.5">Nama Produk</th>
                        <th class="px-6 py-3.5">Kategori</th>
                        <th class="px-6 py-3.5">Harga</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse ($products as $product)
                        <tr class="hover:bg-stone-50/80">
                            <td class="px-6 py-4">
                                @if ($product->image_url)
                                    <img src="{{ $product->image_url }}"
                                         alt="{{ $product->name }}"
                                         class="h-14 w-14 rounded-xl object-cover border border-stone-200">
                                @else
                                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-emerald-50 text-xs font-bold text-[#166534] border border-emerald-100">
                                        RL
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-[#1C1917]">{{ $product->name }}</p>
                                <p class="text-xs text-stone-400">/{{ $product->slug }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-[#D97706]">
                                    {{ $product->category?->name ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-[#166534]">{{ $product->formatted_price }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $product->isAvailable() ? 'bg-emerald-50 text-[#166534]' : 'bg-stone-100 text-stone-600' }}">
                                    {{ $product->isAvailable() ? 'Tersedia' : 'Habis' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="rounded-lg border border-amber-200 bg-amber-50 px-3 py-1.5 text-xs font-semibold text-[#D97706] transition hover:bg-amber-100">
                                        Edit
                                    </a>
                                    <button type="button"
                                            data-delete-url="{{ route('admin.products.destroy', $product) }}"
                                            data-delete-message="Produk &quot;{{ $product->name }}&quot; beserta foto terkait akan dihapus permanen. Lanjutkan?"
                                            class="rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-stone-500">
                                Belum ada produk ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($products->hasPages())
            <div class="border-t border-stone-200 px-6 py-4">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
