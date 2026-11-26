@extends('layouts.public')

@section('title', 'Tentang Kami — Rasa Lampung')

@section('content')
    <section class="border-b border-stone-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
            <span class="text-xs font-bold uppercase tracking-widest text-[#D97706]">Profil UMKM</span>
            <h1 class="mt-2 font-heading text-3xl font-extrabold text-[#1C1917] sm:text-5xl">
                Tentang Rasa Lampung
            </h1>
            <p class="mt-4 max-w-3xl text-base leading-relaxed text-stone-600 sm:text-lg">
                Rasa Lampung merupakan usaha kuliner dan oleh-oleh khas Lampung yang berkomitmen mengangkat cita rasa autentik daerah melalui produk lokal berkualitas tinggi.
            </p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-12">
            <div class="lg:col-span-7 space-y-8">
                <div class="rounded-3xl border border-stone-200 bg-white p-8 shadow-xs">
                    <h2 class="font-heading text-2xl font-bold text-[#1C1917]">Sejarah Singkat</h2>
                    <p class="mt-4 leading-relaxed text-stone-600">
                        Berawal dari dapur keluarga di Bandar Lampung pada tahun 2021, Rasa Lampung memulai perjalanannya dengan mengkurasi produk kuliner unggulan khas Sai Bumi Ruwa Jurai—mulai dari kopi robusta pegunungan Liwa dan Lampung Barat, keripik pisang kepok aneka rasa, hingga sambal dan kudapan tradisional.
                    </p>
                    <p class="mt-4 leading-relaxed text-stone-600">
                        Kini, Rasa Lampung hadir secara digital sebagai pusat informasi dan katalog produk agar masyarakat maupun wisatawan dapat mengenal dan menemukan oleh-oleh khas Lampung secara mudah dan terpercaya.
                    </p>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="rounded-3xl border border-stone-200 bg-[#14532D] p-7 text-white">
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-300">Visi</span>
                        <h3 class="mt-2 font-heading text-xl font-bold">Menjadi Etalase Oleh-Oleh Lampung Terpercaya</h3>
                        <p class="mt-3 text-sm leading-relaxed text-emerald-100/90">
                            Memperkenalkan kekayaan kuliner lokal Lampung ke tingkat nasional dengan kualitas rasa, higienitas, dan penyajian modern.
                        </p>
                    </div>

                    <div class="rounded-3xl border border-stone-200 bg-white p-7 shadow-xs">
                        <span class="text-xs font-bold uppercase tracking-widest text-[#D97706]">Misi</span>
                        <ul class="mt-3 space-y-2.5 text-sm leading-relaxed text-stone-600">
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-[#166534]"></span>
                                <span>Menghadirkan produk kuliner khas Lampung dari bahan lokal terbaik.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-[#166534]"></span>
                                <span>Memberdayakan petani dan perajin UMKM kuliner daerah Lampung.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-[#166534]"></span>
                                <span>Menyajikan katalog digital yang informatif dan mudah diakses.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 space-y-6">
                <div class="rounded-3xl border border-stone-200 bg-white p-8 shadow-xs">
                    <h2 class="font-heading text-xl font-bold text-[#1C1917]">Lokasi &amp; Kontak Usaha</h2>
                    <dl class="mt-6 space-y-5 text-sm">
                        <div>
                            <dt class="font-semibold text-[#166534]">Alamat Gerai</dt>
                            <dd class="mt-1 text-stone-600">
                                Jl. Raden Intan No. 88, Enggal, Tanjung Karang Pusat, Kota Bandar Lampung, Lampung 35118
                            </dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-[#166534]">Jam Operasional</dt>
                            <dd class="mt-1 text-stone-600">Senin – Minggu, pukul 08.00 – 21.00 WIB</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-[#166534]">Telepon / WhatsApp</dt>
                            <dd class="mt-1 text-stone-600">(0721) 555-0188 / +62 812-7000-1880</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-[#166534]">Email Resmi</dt>
                            <dd class="mt-1 text-stone-600">halo@rasalampung.id</dd>
                        </div>
                    </dl>
                </div>

                <div class="rounded-3xl border border-amber-200 bg-amber-50/70 p-7">
                    <p class="text-xs font-bold uppercase tracking-widest text-[#D97706]">Ringkasan Katalog</p>
                    <p class="mt-2 font-heading text-lg font-bold text-[#1C1917]">
                        Saat ini tersedia {{ $totalProducts }} produk dalam {{ $totalCategories }} kategori pilihan.
                    </p>
                    <a href="{{ route('products.index') }}"
                       class="mt-5 inline-flex items-center gap-2 rounded-xl bg-[#166534] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#14532D]">
                        Lihat Katalog Produk &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
