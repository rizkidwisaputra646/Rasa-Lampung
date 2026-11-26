@php
    $isEdit = isset($product);
@endphp

<div class="grid gap-6 lg:grid-cols-12">
    <div class="lg:col-span-8 space-y-5">
        <div>
            <label for="name" class="block text-sm font-semibold text-[#1C1917]">Nama Produk <span class="text-red-500">*</span></label>
            <input id="name"
                   type="text"
                   name="name"
                   value="{{ old('name', $product->name ?? '') }}"
                   required
                   placeholder="Contoh: Kopi Robusta Lampung"
                   class="mt-2 w-full rounded-xl border px-4 py-3 text-sm transition focus:outline-none focus:ring-2 {{ $errors->has('name') ? 'border-red-400 bg-red-50/40 focus:ring-red-200' : 'border-stone-300 bg-[#FAFAF5] focus:border-[#166534] focus:bg-white focus:ring-[#166534]/20' }}">
            @error('name')
                <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="category_id" class="block text-sm font-semibold text-[#1C1917]">Kategori <span class="text-red-500">*</span></label>
                <select id="category_id"
                        name="category_id"
                        required
                        class="mt-2 w-full rounded-xl border px-4 py-3 text-sm transition focus:outline-none focus:ring-2 {{ $errors->has('category_id') ? 'border-red-400 bg-red-50/40 focus:ring-red-200' : 'border-stone-300 bg-[#FAFAF5] focus:border-[#166534] focus:bg-white focus:ring-[#166534]/20' }}">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) old('category_id', $product->category_id ?? '') === (string) $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-semibold text-[#1C1917]">Harga (Rp) <span class="text-red-500">*</span></label>
                <input id="price"
                       type="number"
                       name="price"
                       min="1"
                       step="1"
                       value="{{ old('price', $product->price ?? '') }}"
                       required
                       placeholder="Contoh: 45000"
                       class="mt-2 w-full rounded-xl border px-4 py-3 text-sm transition focus:outline-none focus:ring-2 {{ $errors->has('price') ? 'border-red-400 bg-red-50/40 focus:ring-red-200' : 'border-stone-300 bg-[#FAFAF5] focus:border-[#166534] focus:bg-white focus:ring-[#166534]/20' }}">
                @error('price')
                    <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="stock_status" class="block text-sm font-semibold text-[#1C1917]">Status Ketersediaan <span class="text-red-500">*</span></label>
            <select id="stock_status"
                    name="stock_status"
                    required
                    class="mt-2 w-full rounded-xl border px-4 py-3 text-sm transition focus:outline-none focus:ring-2 {{ $errors->has('stock_status') ? 'border-red-400 bg-red-50/40 focus:ring-red-200' : 'border-stone-300 bg-[#FAFAF5] focus:border-[#166534] focus:bg-white focus:ring-[#166534]/20' }}">
                <option value="available" @selected(old('stock_status', $product->stock_status ?? 'available') === 'available')>Tersedia (available)</option>
                <option value="sold_out" @selected(old('stock_status', $product->stock_status ?? '') === 'sold_out')>Stok Habis (sold_out)</option>
            </select>
            @error('stock_status')
                <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-semibold text-[#1C1917]">Deskripsi Produk <span class="text-red-500">*</span></label>
            <textarea id="description"
                      name="description"
                      rows="5"
                      required
                      placeholder="Jelaskan cita rasa, bahan baku, berat bersih, dan keunggulan produk..."
                      class="mt-2 w-full rounded-xl border px-4 py-3 text-sm transition focus:outline-none focus:ring-2 {{ $errors->has('description') ? 'border-red-400 bg-red-50/40 focus:ring-red-200' : 'border-stone-300 bg-[#FAFAF5] focus:border-[#166534] focus:bg-white focus:ring-[#166534]/20' }}">{{ old('description', $product->description ?? '') }}</textarea>
            @error('description')
                <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="lg:col-span-4">
        <div class="rounded-2xl border border-stone-200 bg-[#FAFAF5] p-5">
            <label for="image" class="block text-sm font-semibold text-[#1C1917]">Foto Produk</label>
            <p class="mt-1 text-xs text-stone-500">Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.</p>

            <div class="mt-4 overflow-hidden rounded-2xl border border-stone-200 bg-white aspect-[4/3] flex items-center justify-center">
                @if ($isEdit && $product->image_url)
                    <img id="image-preview" src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                @else
                    <img id="image-preview" src="" alt="Preview foto produk" class="hidden h-full w-full object-cover">
                    <div id="image-placeholder" class="p-6 text-center text-xs text-stone-400">
                        Preview foto akan tampil di sini
                    </div>
                @endif
            </div>

            <input id="image"
                   type="file"
                   name="image"
                   accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                   class="mt-4 block w-full text-xs text-stone-600 file:mr-3 file:rounded-xl file:border-0 file:bg-[#166534] file:px-4 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-[#14532D]">
            @error('image')
                <p class="mt-2 text-xs font-medium text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('image')?.addEventListener('change', function (e) {
        const file = e.target.files?.[0];
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('image-placeholder');
        if (!file || !preview) return;

        const reader = new FileReader();
        reader.onload = function (event) {
            preview.src = event.target?.result;
            preview.classList.remove('hidden');
            placeholder?.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    });
</script>
@endpush
