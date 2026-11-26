@props(['product'])

<article class="group flex flex-col overflow-hidden rounded-2xl border border-stone-200/90 bg-white shadow-xs transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
    <a href="{{ route('products.show', $product->slug) }}" class="relative block aspect-[4/3] overflow-hidden bg-stone-100">
        @if ($product->image_url)
            <img src="{{ $product->image_url }}"
                 alt="{{ $product->name }}"
                 class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
        @else
            <div class="flex h-full w-full flex-col items-center justify-center bg-gradient-to-br from-emerald-50 to-amber-50 p-6 text-center">
                <svg class="h-12 w-12 text-[#166534]/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                </svg>
                <span class="mt-2 text-xs font-medium text-stone-500">Rasa Lampung</span>
            </div>
        @endif

        <span class="absolute top-3 right-3 rounded-full px-3 py-1 text-xs font-semibold shadow-xs {{ $product->isAvailable() ? 'bg-[#166534] text-white' : 'bg-stone-800/85 text-stone-100' }}">
            {{ $product->isAvailable() ? 'Tersedia' : 'Habis' }}
        </span>
    </a>

    <div class="flex flex-1 flex-col p-5">
        <div class="mb-2 flex items-center justify-between gap-2">
            <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-semibold text-[#D97706] border border-amber-200/70">
                {{ $product->category?->name ?? 'Umum' }}
            </span>
        </div>

        <h3 class="font-heading text-lg font-bold text-[#1C1917] line-clamp-1 group-hover:text-[#166534] transition-colors">
            <a href="{{ route('products.show', $product->slug) }}">
                {{ $product->name }}
            </a>
        </h3>

        <p class="mt-2 text-sm leading-relaxed text-stone-600 line-clamp-2">
            {{ \Illuminate\Support\Str::limit($product->description, 95) }}
        </p>

        <div class="mt-auto pt-5 flex items-center justify-between gap-3 border-t border-stone-100">
            <div>
                <span class="block text-[11px] font-medium uppercase tracking-wide text-stone-400">Harga</span>
                <span class="font-heading text-lg font-extrabold text-[#166534]">{{ $product->formatted_price }}</span>
            </div>
            <a href="{{ route('products.show', $product->slug) }}"
               class="inline-flex items-center gap-1.5 rounded-xl bg-[#166534] px-4 py-2.5 text-xs font-semibold text-white transition-colors hover:bg-[#14532D]">
                Lihat Detail
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>
    </div>
</article>
