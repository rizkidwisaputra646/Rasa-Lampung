<p align="center">
  <img src="public/images/logo-rasa-lampung.png" alt="Logo Rasa Lampung" width="240" />
</p>

<h1 align="center">Rasa Lampung — Website Katalog UMKM</h1>

<p align="center">
  Katalog digital kuliner dan oleh-oleh khas Lampung berbasis <strong>Laravel 12</strong>, <strong>Blade</strong>, <strong>Tailwind CSS 4</strong>, dan <strong>MySQL</strong>, dilengkapi halaman publik dan dashboard administrator yang sepenuhnya terhubung ke database.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white" alt="Laravel 12" />
  <img src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP 8.2+" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-4.x-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white" alt="Tailwind CSS 4" />
  <img src="https://img.shields.io/badge/Database-MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white" alt="MySQL" />
</p>

---

## Ringkasan Proyek

**Rasa Lampung** adalah aplikasi web katalog UMKM kuliner dan oleh-oleh khas Lampung yang dirancang untuk memperkenalkan produk lokal kepada pengunjung secara dinamis, sekaligus memudahkan pengelola dalam mengelola data produk, kategori, dan foto produk melalui dashboard admin.

---

## Fitur Utama

### Website Publik
- **Beranda (`/`)**: Menampilkan hero section promosi, ringkasan statistik katalog dari database, daftar kategori, produk unggulan, dan profil singkat usaha.
- **Katalog Produk (`/produk`)**: Menampilkan seluruh produk dari database dengan filter kategori (`?kategori=...`), pencarian nama produk (`?cari=...`), dan pagination.
- **Detail Produk (`/produk/{slug}`)**: Menampilkan foto produk, harga, kategori, status ketersediaan (`Tersedia` / `Habis`), deskripsi lengkap, serta produk terkait (mendukung parameter `slug` maupun `id`).
- **Tentang Kami (`/tentang`)**: Menampilkan profil usaha, sejarah singkat, visi dan misi, informasi kontak, serta alamat gerai.

### Dashboard Administrator *(Dilindungi Middleware `auth`)*
- **Autentikasi (`/login`, `/logout`)**: Halaman login, validasi kredensial, regenerasi sesi, dan logout aman.
- **Dashboard Ringkasan (`/admin/dashboard`)**: Menampilkan total produk, total kategori, jumlah produk tersedia, produk terbaru, daftar 5 produk terakhir, dan distribusi kategori.
- **Manajemen Produk (`/admin/products`)**:
  - Tabel daftar produk dengan pencarian, filter kategori, dan pagination.
  - Tambah & edit produk dengan validasi server (`StoreProductRequest` & `UpdateProductRequest`).
  - Upload foto produk ke `storage/app/public/products` (JPG, JPEG, PNG, WEBP, maks. 2 MB) dengan nama file UUID unik.
  - Otomatis menghapus foto lama dari storage saat foto diganti atau produk dihapus, dilengkapi modal konfirmasi hapus.
- **Manajemen Kategori (`/admin/categories`)**:
  - Tambah, edit (modal), dan hapus kategori dengan validasi unik.
  - Proteksi penghapusan: kategori yang masih digunakan oleh produk tidak dapat dihapus dan menampilkan pesan peringatan.

---

## Tech Stack

| Komponen | Teknologi |
|---|---|
| Backend | Laravel 12 (`^12.0`), PHP `^8.2` |
| Frontend | Laravel Blade Template |
| Styling & Build | Tailwind CSS 4 (`@tailwindcss/vite`), Vite 6 |
| Database | MySQL (`utf8mb4`) |
| ORM | Eloquent ORM |
| Storage | Laravel Public Storage (`storage/app/public`) |
| Testing | PHPUnit 11 |

---

## Desain Database & Relasi

Aplikasi menggunakan tiga tabel utama:

1. **`users`** — Akun administrator untuk autentikasi dashboard.
2. **`categories`** — Data kategori produk (`id`, `name`, `slug`, `description`, timestamps).
3. **`products`** — Data produk (`id`, `category_id` FK -> `categories.id` dengan `restrictOnDelete`, `name`, `slug`, `price`, `description`, `image`, `stock_status`, timestamps).

Relasi Eloquent:
- `Category` `hasMany(Product::class)`
- `Product` `belongsTo(Category::class)`

---

## Daftar Route

### Public Routes
| Method | URL | Controller | Fungsi |
|---|---|---|---|
| `GET` | `/` | `PublicController@home` | Halaman beranda |
| `GET` | `/produk` | `PublicController@products` | Katalog produk (filter, pencarian, pagination) |
| `GET` | `/produk/{slug}` | `PublicController@productDetail` | Detail produk (by `slug` atau `id`) |
| `GET` | `/tentang` | `PublicController@about` | Halaman tentang usaha |

### Authentication Routes
| Method | URL | Controller | Fungsi |
|---|---|---|---|
| `GET` | `/login` | `AuthController@showLogin` | Halaman login |
| `POST` | `/login` | `AuthController@login` | Proses login |
| `POST` | `/logout` | `AuthController@logout` | Logout |

### Admin Routes *(Middleware `auth`)*
| Method | URL | Controller | Fungsi |
|---|---|---|---|
| `GET` | `/admin/dashboard` | `Admin\DashboardController@index` | Ringkasan dashboard |
| `GET` | `/admin/products` | `ProductController@index` | Daftar produk |
| `GET` | `/admin/products/create` | `ProductController@create` | Form tambah produk |
| `POST` | `/admin/products` | `ProductController@store` | Simpan produk baru |
| `GET` | `/admin/products/{product}/edit` | `ProductController@edit` | Form edit produk |
| `PUT` | `/admin/products/{product}` | `ProductController@update` | Perbarui produk |
| `DELETE` | `/admin/products/{product}` | `ProductController@destroy` | Hapus produk & gambar |
| `GET` | `/admin/categories` | `CategoryController@index` | Daftar kategori |
| `POST` | `/admin/categories` | `CategoryController@store` | Tambah kategori |
| `PUT` | `/admin/categories/{category}` | `CategoryController@update` | Perbarui kategori |
| `DELETE` | `/admin/categories/{category}` | `CategoryController@destroy` | Hapus kategori |

---

## Panduan Instalasi Lokal

### Prasyarat
- PHP >= 8.2 (ekstensi `pdo_mysql`, `pdo_sqlite`, `mbstring`, `openssl`, `fileinfo`)
- Composer
- Node.js & npm
- MySQL Server (misalnya via XAMPP)

### Langkah Setup

1. **Clone repository dan masuk ke direktori proyek**
   ```bash
   git clone <URL_REPOSITORY_ANDA>
   cd uts-web-2
   ```

2. **Install dependensi PHP dan JavaScript**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi file environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Sesuaikan konfigurasi database MySQL pada file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=rasa_lampung
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Buat database MySQL**
   Buat database bernama `rasa_lampung` di MySQL/phpMyAdmin.

5. **Buat symlink public storage dan jalankan migrasi + seeder**
   ```bash
   php artisan storage:link
   php artisan migrate --seed
   ```

6. **Build aset frontend dan jalankan server lokal**
   ```bash
   npm run build
   php artisan serve
   ```
   Buka aplikasi di browser pada `http://127.0.0.1:8000`.

---

## Akun & Data Awal (Seeder)

Menjalankan `php artisan migrate --seed` (atau `php artisan db:seed`) akan mengisi:
- **1 Akun Administrator** (`AdminSeeder`):
  - **Email:** `admin@rasalampung.test`
  - **Password:** `password123`
- **5 Kategori Produk** (`CategorySeeder`): `Kopi Lampung`, `Keripik dan Camilan`, `Sambal dan Makanan`, `Oleh-Oleh Khas Lampung`, dan `Minuman Tradisional`.
- **9 Produk Contoh** (`ProductSeeder`) beserta aset gambar produk di `storage/app/public/products/`.

---

## Pengujian

Aplikasi dilengkapi feature tests di `tests/Feature/RasaLampungTest.php` yang berjalan menggunakan SQLite `:memory:` (dikonfigurasi di `phpunit.xml` agar tidak mengganggu database pengembangan MySQL).

Jalankan seluruh test suite dengan perintah:
```bash
php artisan test
```

Cakupan pengujian:
- Render halaman publik (`/`, `/produk`, `/produk/{slug}`, `/produk/{id}`, `/tentang`).
- Relasi Eloquent `Category` ↔ `Product`.
- Proteksi middleware `auth`, validasi login, redirect intended, dan logout.
- CRUD produk lengkap dengan validasi server, upload gambar ke disk `public`, penghapusan gambar lama saat update, dan penghapusan gambar saat produk dihapus.
- CRUD kategori dan proteksi penghapusan kategori yang masih digunakan oleh produk.

---

## Identitas Visual

| Elemen | Nilai |
|---|---|
| Primary | `#166534` |
| Secondary | `#14532D` |
| Accent | `#D97706` |
| Background | `#FAFAF5` |
| Text | `#1C1917` |
| Card | `#FFFFFF` |
| Font Heading | `Plus Jakarta Sans` |
| Font Body | `Inter` |
