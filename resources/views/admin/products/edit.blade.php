@extends('layouts.admin')

@section('title', 'Edit Produk — Rasa Lampung')
@section('page_title', 'Edit Produk')

@section('content')
    <div class="rounded-3xl border border-stone-200 bg-white p-6 sm:p-8 shadow-xs">
        <div class="mb-6 flex items-center justify-between border-b border-stone-200 pb-4">
            <div>
                <h2 class="font-heading text-xl font-bold text-[#1C1917]">Edit: {{ $product->name }}</h2>
                <p class="mt-1 text-sm text-stone-500">Perbarui informasi produk atau unggah foto baru untuk mengganti foto lama.</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-stone-600 hover:text-[#166534]">
                &larr; Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            @include('admin.products._form', ['product' => $product])

            <div class="mt-8 flex items-center justify-end gap-3 border-t border-stone-200 pt-6">
                <a href="{{ route('admin.products.index') }}"
                   class="rounded-xl border border-stone-300 bg-white px-5 py-2.5 text-sm font-medium text-stone-700 hover:bg-stone-100">
                    Batal
                </a>
                <button type="submit"
                        class="rounded-xl bg-[#166534] px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-[#14532D]">
                    Perbarui Produk
                </button>
            </div>
        </form>
    </div>
@endsection
