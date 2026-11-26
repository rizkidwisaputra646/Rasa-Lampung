@extends('layouts.admin')

@section('title', 'Manajemen Kategori — Rasa Lampung')
@section('page_title', 'Manajemen Kategori')

@section('content')
    <div class="grid gap-8 lg:grid-cols-12 items-start">
        {{-- Create Category Form --}}
        <div class="lg:col-span-4 rounded-3xl border border-stone-200 bg-white p-6 shadow-xs">
            <h2 class="font-heading text-lg font-bold text-[#1C1917]">Tambah Kategori Baru</h2>
            <p class="mt-1 text-xs text-stone-500">Kelompokkan produk agar mudah ditemukan pengunjung.</p>

            <form method="POST" action="{{ route('admin.categories.store') }}" class="mt-5 space-y-4" novalidate>
                @csrf
                <input type="hidden" name="_form_mode" value="create">

                <div>
                    <label for="create_name" class="block text-sm font-semibold text-[#1C1917]">Nama Kategori <span class="text-red-500">*</span></label>
                    <input id="create_name"
                           type="text"
                           name="name"
                           value="{{ old('_form_mode') === 'create' ? old('name') : '' }}"
                           required
                           placeholder="Contoh: Minuman Tradisional"
                           class="mt-1.5 w-full rounded-xl border px-3.5 py-2.5 text-sm transition focus:outline-none focus:ring-2 {{ old('_form_mode', 'create') === 'create' && $errors->has('name') ? 'border-red-400 bg-red-50/40 focus:ring-red-200' : 'border-stone-300 bg-[#FAFAF5] focus:border-[#166534] focus:bg-white focus:ring-[#166534]/20' }}">
                    @if (old('_form_mode', 'create') === 'create')
                        @error('name')
                            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    @endif
                </div>

                <div>
                    <label for="create_description" class="block text-sm font-semibold text-[#1C1917]">Deskripsi (Opsional)</label>
                    <textarea id="create_description"
                              name="description"
                              rows="3"
                              placeholder="Deskripsi singkat kategori..."
                              class="mt-1.5 w-full rounded-xl border px-3.5 py-2.5 text-sm transition focus:outline-none focus:ring-2 {{ old('_form_mode', 'create') === 'create' && $errors->has('description') ? 'border-red-400 bg-red-50/40 focus:ring-red-200' : 'border-stone-300 bg-[#FAFAF5] focus:border-[#166534] focus:bg-white focus:ring-[#166534]/20' }}">{{ old('_form_mode') === 'create' ? old('description') : '' }}</textarea>
                    @if (old('_form_mode', 'create') === 'create')
                        @error('description')
                            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    @endif
                </div>

                <button type="submit"
                        class="w-full rounded-xl bg-[#166534] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#14532D]">
                    Tambah Kategori
                </button>
            </form>
        </div>

        {{-- Categories List Table --}}
        <div class="lg:col-span-8 rounded-3xl border border-stone-200 bg-white shadow-xs overflow-hidden">
            <div class="border-b border-stone-200 px-6 py-5">
                <h2 class="font-heading text-lg font-bold text-[#1C1917]">Daftar Kategori</h2>
                <p class="mt-1 text-xs text-stone-500">Kategori yang masih memiliki produk tidak dapat dihapus sebelum produk dipindahkan atau dihapus.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-stone-200 text-sm">
                    <thead class="bg-[#FAFAF5] text-left text-xs font-semibold uppercase tracking-wider text-stone-500">
                        <tr>
                            <th class="px-6 py-3.5">Nama Kategori</th>
                            <th class="px-6 py-3.5">Deskripsi</th>
                            <th class="px-6 py-3.5 text-center">Produk</th>
                            <th class="px-6 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @forelse ($categories as $category)
                            <tr class="hover:bg-stone-50/80">
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-[#1C1917]">{{ $category->name }}</p>
                                    <p class="text-xs text-stone-400">/{{ $category->slug }}</p>
                                </td>
                                <td class="px-6 py-4 text-stone-600 max-w-xs">
                                    {{ $category->description ?: '-' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-[#166534]">
                                        {{ $category->products_count }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <button type="button"
                                                data-edit-category
                                                data-update-url="{{ route('admin.categories.update', $category) }}"
                                                data-category-id="{{ $category->id }}"
                                                data-category-name="{{ $category->name }}"
                                                data-category-description="{{ $category->description ?? '' }}"
                                                class="rounded-lg border border-amber-200 bg-amber-50 px-3 py-1.5 text-xs font-semibold text-[#D97706] transition hover:bg-amber-100">
                                            Edit
                                        </button>
                                        <button type="button"
                                                data-delete-url="{{ route('admin.categories.destroy', $category) }}"
                                                data-delete-message="{{ $category->products_count > 0 ? 'Kategori &quot;'.$category->name.'&quot; masih digunakan oleh '.$category->products_count.' produk.' : 'Hapus kategori &quot;'.$category->name.'&quot;?' }}"
                                                class="rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-stone-500">
                                    Belum ada kategori terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Edit Category Modal --}}
    <div id="edit-category-modal"
         class="fixed inset-0 z-50 {{ old('_form_mode') === 'edit' ? 'flex' : 'hidden' }} items-center justify-center bg-black/50 p-4"
         role="dialog"
         aria-modal="true"
         aria-labelledby="edit-category-title">
        <div class="w-full max-w-md rounded-3xl border border-stone-200 bg-white p-6 shadow-xl">
            <div class="flex items-center justify-between border-b border-stone-200 pb-3">
                <h2 id="edit-category-title" class="font-heading text-lg font-bold text-[#1C1917]">Edit Kategori</h2>
                <button type="button" id="edit-category-close" class="text-stone-400 hover:text-stone-700 text-xl leading-none">&times;</button>
            </div>

            <form id="edit-category-form"
                  method="POST"
                  action="{{ old('_form_mode') === 'edit' && old('_edit_category_id') ? route('admin.categories.update', old('_edit_category_id')) : '' }}"
                  class="mt-5 space-y-4"
                  novalidate>
                @csrf
                @method('PUT')
                <input type="hidden" name="_form_mode" value="edit">
                <input type="hidden" id="edit_category_id" name="_edit_category_id" value="{{ old('_edit_category_id') }}">

                <div>
                    <label for="edit_category_name" class="block text-sm font-semibold text-[#1C1917]">Nama Kategori <span class="text-red-500">*</span></label>
                    <input id="edit_category_name"
                           type="text"
                           name="name"
                           value="{{ old('_form_mode') === 'edit' ? old('name') : '' }}"
                           required
                           class="mt-1.5 w-full rounded-xl border px-3.5 py-2.5 text-sm transition focus:outline-none focus:ring-2 {{ old('_form_mode') === 'edit' && $errors->has('name') ? 'border-red-400 bg-red-50/40 focus:ring-red-200' : 'border-stone-300 bg-[#FAFAF5] focus:border-[#166534] focus:bg-white focus:ring-[#166534]/20' }}">
                    @if (old('_form_mode') === 'edit')
                        @error('name')
                            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    @endif
                </div>

                <div>
                    <label for="edit_category_description" class="block text-sm font-semibold text-[#1C1917]">Deskripsi (Opsional)</label>
                    <textarea id="edit_category_description"
                              name="description"
                              rows="3"
                              class="mt-1.5 w-full rounded-xl border px-3.5 py-2.5 text-sm transition focus:outline-none focus:ring-2 {{ old('_form_mode') === 'edit' && $errors->has('description') ? 'border-red-400 bg-red-50/40 focus:ring-red-200' : 'border-stone-300 bg-[#FAFAF5] focus:border-[#166534] focus:bg-white focus:ring-[#166534]/20' }}">{{ old('_form_mode') === 'edit' ? old('description') : '' }}</textarea>
                    @if (old('_form_mode') === 'edit')
                        @error('description')
                            <p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>
                        @enderror
                    @endif
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="button" id="edit-category-cancel" class="rounded-xl border border-stone-300 bg-white px-4 py-2 text-sm font-medium text-stone-700 hover:bg-stone-100">
                        Batal
                    </button>
                    <button type="submit" class="rounded-xl bg-[#166534] px-5 py-2 text-sm font-semibold text-white hover:bg-[#14532D]">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (function () {
        const modal = document.getElementById('edit-category-modal');
        const form = document.getElementById('edit-category-form');
        const idInput = document.getElementById('edit_category_id');
        const nameInput = document.getElementById('edit_category_name');
        const descInput = document.getElementById('edit_category_description');

        document.querySelectorAll('[data-edit-category]').forEach((btn) => {
            btn.addEventListener('click', () => {
                form.setAttribute('action', btn.getAttribute('data-update-url'));
                idInput.value = btn.getAttribute('data-category-id');
                nameInput.value = btn.getAttribute('data-category-name');
                descInput.value = btn.getAttribute('data-category-description');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        });

        function closeModal() {
            modal?.classList.add('hidden');
            modal?.classList.remove('flex');
        }

        document.getElementById('edit-category-close')?.addEventListener('click', closeModal);
        document.getElementById('edit-category-cancel')?.addEventListener('click', closeModal);
        modal?.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });
    })();
</script>
@endpush
