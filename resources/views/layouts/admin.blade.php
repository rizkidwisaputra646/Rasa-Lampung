<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard — Rasa Lampung')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-rasa-lampung.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#FAFAF5] text-[#1C1917] antialiased">
    <div class="min-h-screen flex">
        {{-- Mobile Sidebar Backdrop --}}
        <div id="admin-sidebar-backdrop" class="fixed inset-0 z-40 hidden bg-black/40 lg:hidden"></div>

        {{-- Sidebar Navigation --}}
        <aside id="admin-sidebar"
               class="fixed inset-y-0 left-0 z-50 w-68 -translate-x-full bg-[#14532D] text-white transition-transform duration-200 lg:static lg:translate-x-0 flex flex-col justify-between shrink-0">
            <div>
                <div class="flex items-center justify-between border-b border-emerald-800/80 px-6 py-5">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-rasa-lampung.png') }}"
                             alt="Logo Rasa Lampung"
                             class="h-11 w-auto rounded-xl bg-white px-1.5 py-1 object-contain shadow-xs">
                        <div>
                            <span class="block font-heading text-base font-extrabold text-white">Rasa Lampung</span>
                            <span class="block text-[11px] uppercase tracking-wider text-emerald-200">Admin Panel</span>
                        </div>
                    </a>
                    <button type="button" id="admin-sidebar-close" class="rounded-lg p-1.5 text-emerald-200 hover:bg-emerald-800 lg:hidden" aria-label="Tutup sidebar">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <nav class="p-4 space-y-1.5" aria-label="Navigasi Admin">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-white text-[#14532D] font-semibold shadow-xs' : 'text-emerald-100 hover:bg-emerald-800/70 hover:text-white' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/>
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.products.index') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('admin.products.*') ? 'bg-white text-[#14532D] font-semibold shadow-xs' : 'text-emerald-100 hover:bg-emerald-800/70 hover:text-white' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/>
                        </svg>
                        Manajemen Produk
                    </a>

                    <a href="{{ route('admin.categories.index') }}"
                       class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition {{ request()->routeIs('admin.categories.*') ? 'bg-white text-[#14532D] font-semibold shadow-xs' : 'text-emerald-100 hover:bg-emerald-800/70 hover:text-white' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z"/>
                        </svg>
                        Manajemen Kategori
                    </a>

                    <div class="pt-4 mt-4 border-t border-emerald-800/80">
                        <a href="{{ route('home') }}"
                           class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-emerald-100 transition hover:bg-emerald-800/70 hover:text-white">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                            </svg>
                            Lihat Website Publik
                        </a>
                    </div>
                </nav>
            </div>

            <div class="border-t border-emerald-800/80 p-4">
                <div class="mb-3 rounded-xl bg-emerald-900/60 px-4 py-3">
                    <p class="text-xs font-semibold text-amber-300">Administrator</p>
                    <p class="mt-0.5 text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-emerald-200 truncate">{{ auth()->user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-xl border border-emerald-700 bg-emerald-900/40 px-4 py-2.5 text-sm font-semibold text-emerald-100 transition hover:bg-red-600 hover:border-red-600 hover:text-white">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-w-0">
            {{-- Topbar --}}
            <header class="sticky top-0 z-30 border-b border-stone-200 bg-white/95 backdrop-blur-md">
                <div class="flex h-16 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center gap-3">
                        <button type="button" id="admin-sidebar-open"
                                class="inline-flex items-center justify-center rounded-xl border border-stone-300 p-2 text-stone-700 lg:hidden hover:bg-stone-100"
                                aria-label="Buka menu admin">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        <div>
                            <h1 class="font-heading text-lg font-bold text-[#1C1917]">@yield('page_title', 'Dashboard')</h1>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.products.create') }}"
                           class="inline-flex items-center gap-1.5 rounded-xl bg-[#166534] px-4 py-2 text-xs sm:text-sm font-semibold text-white transition hover:bg-[#14532D]">
                            <span>+ Tambah Produk</span>
                        </a>
                    </div>
                </div>
            </header>

            {{-- Toast Notifications --}}
            <div class="px-4 sm:px-6 lg:px-8 pt-6 space-y-3">
                @if (session('success'))
                    <div role="alert" data-toast class="flex items-center justify-between gap-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-3.5 text-sm font-medium text-[#166534] shadow-xs">
                        <span>{{ session('success') }}</span>
                        <button type="button" onclick="this.closest('[data-toast]').remove()" class="text-[#166534]/70 hover:text-[#166534]" aria-label="Tutup notifikasi">&times;</button>
                    </div>
                @endif

                @if (session('error'))
                    <div role="alert" data-toast class="flex items-center justify-between gap-4 rounded-2xl border border-red-200 bg-red-50 px-5 py-3.5 text-sm font-medium text-red-700 shadow-xs">
                        <span>{{ session('error') }}</span>
                        <button type="button" onclick="this.closest('[data-toast]').remove()" class="text-red-700/70 hover:text-red-800" aria-label="Tutup notifikasi">&times;</button>
                    </div>
                @endif
            </div>

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Global Delete Confirmation Modal --}}
    <div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4" role="dialog" aria-modal="true" aria-labelledby="delete-modal-title">
        <div class="w-full max-w-md rounded-3xl border border-stone-200 bg-white p-6 shadow-xl">
            <div class="flex items-start gap-4">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-red-50 text-red-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                    </svg>
                </div>
                <div>
                    <h2 id="delete-modal-title" class="font-heading text-lg font-bold text-[#1C1917]">Konfirmasi Hapus</h2>
                    <p id="delete-modal-message" class="mt-1.5 text-sm text-stone-600">Apakah Anda yakin ingin menghapus item ini?</p>
                </div>
            </div>

            <form id="delete-modal-form" method="POST" action="" class="mt-6 flex items-center justify-end gap-3">
                @csrf
                @method('DELETE')
                <button type="button" id="delete-modal-cancel"
                        class="rounded-xl border border-stone-300 bg-white px-4 py-2.5 text-sm font-medium text-stone-700 hover:bg-stone-100">
                    Batal
                </button>
                <button type="submit"
                        class="rounded-xl bg-red-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-700">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>

    <script>
        (function () {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('admin-sidebar-backdrop');
            const openBtn = document.getElementById('admin-sidebar-open');
            const closeBtn = document.getElementById('admin-sidebar-close');

            function toggleSidebar(show) {
                sidebar?.classList.toggle('-translate-x-full', !show);
                backdrop?.classList.toggle('hidden', !show);
            }

            openBtn?.addEventListener('click', () => toggleSidebar(true));
            closeBtn?.addEventListener('click', () => toggleSidebar(false));
            backdrop?.addEventListener('click', () => toggleSidebar(false));

            const modal = document.getElementById('delete-modal');
            const modalForm = document.getElementById('delete-modal-form');
            const modalMsg = document.getElementById('delete-modal-message');
            const modalCancel = document.getElementById('delete-modal-cancel');

            document.querySelectorAll('[data-delete-url]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    modalForm.setAttribute('action', btn.getAttribute('data-delete-url'));
                    modalMsg.textContent = btn.getAttribute('data-delete-message') || 'Apakah Anda yakin ingin menghapus data ini?';
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            });

            function closeDeleteModal() {
                modal?.classList.add('hidden');
                modal?.classList.remove('flex');
            }

            modalCancel?.addEventListener('click', closeDeleteModal);
            modal?.addEventListener('click', (e) => {
                if (e.target === modal) closeDeleteModal();
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>
