# PRODUCT REQUIREMENTS DOCUMENT (PRD)
# RASA LAMPUNG — Website Katalog UMKM

**Versi:** 1.0  
**Jenis Proyek:** Ujian Tengah Semester (UTS) Pemrograman Web  
**Framework:** Laravel 12  
**Frontend:** Blade Template + Tailwind CSS 4  
**Database:** PostgreSQL  
**ORM:** Eloquent ORM  
**Storage:** Laravel Public Storage

---

# 1. PROJECT OVERVIEW

## 1.1 Nama Usaha

**RASA LAMPUNG**

Jenis usaha: UMKM kuliner dan oleh-oleh khas Lampung.

Nama badan usaha yang digunakan: **Rasa Lampung**.

## 1.2 Deskripsi Usaha

Rasa Lampung merupakan usaha kuliner yang menyediakan berbagai produk makanan, minuman, dan oleh-oleh khas Lampung. Usaha ini menghadirkan produk lokal berkualitas dengan cita rasa khas daerah Lampung.

Website Rasa Lampung dikembangkan sebagai media informasi dan katalog digital untuk memperkenalkan produk kepada calon pelanggan. Pengunjung dapat melihat daftar produk, kategori, harga, foto, dan deskripsi produk.

Admin memiliki akses untuk mengelola informasi produk dan kategori melalui halaman dashboard.

## 1.3 Tujuan Website

1. Memperkenalkan UMKM Rasa Lampung kepada masyarakat.
2. Menampilkan katalog produk secara dinamis dari database.
3. Memudahkan pengelolaan produk dan kategori.
4. Menyediakan informasi produk secara lengkap.
5. Menerapkan konsep CRUD, relasi database, validasi, dan upload file menggunakan Laravel.

# 2. TECHNOLOGY STACK

| Komponen | Teknologi |
|---|---|
| Backend | Laravel 12 |
| Frontend | Blade |
| CSS Framework | Tailwind CSS 4 |
| Database | PostgreSQL |
| ORM | Eloquent ORM |
| Build Tool | Vite |
| Authentication | Laravel Authentication |
| Image Storage | Laravel Storage |
| Server Validation | Laravel Validation |
| Database Seeding | Laravel Seeder |

Ketentuan implementasi:
- Tidak menggunakan React, Vue, atau framework frontend terpisah.
- Seluruh halaman menggunakan Blade Template.
- Tailwind CSS digunakan untuk styling.
- Seluruh data produk dan kategori diambil dari database.
- Tidak menggunakan data hardcoded untuk katalog produk.

# 3. TARGET PENGGUNA

## 3.1 Pengunjung (Public)

Pengunjung dapat:
- Mengakses halaman beranda.
- Melihat profil usaha.
- Melihat seluruh produk.
- Melihat produk berdasarkan kategori.
- Melihat detail produk.

Pengunjung tidak perlu login.

## 3.2 Administrator

Administrator dapat:
- Login ke dashboard.
- Melihat ringkasan data.
- Menambahkan produk.
- Mengedit produk.
- Menghapus produk.
- Mengelola kategori.
- Mengunggah dan mengganti foto produk.

# 4. WEBSITE FEATURES

## 4.1 Public Website

### A. Homepage

Halaman utama website berisi:

1. Navbar dengan logo Rasa Lampung.
2. Menu Beranda, Produk, dan Tentang Kami.
3. Hero section dengan headline promosi.
4. Deskripsi singkat usaha.
5. Produk unggulan.
6. Daftar kategori produk.
7. Section tentang usaha.
8. Footer berisi informasi usaha.

Headline contoh:

"Kenali Cita Rasa Khas Lampung"

Subheadline:

"Temukan berbagai pilihan kuliner dan oleh-oleh khas Lampung dengan cita rasa lokal yang istimewa."

### B. Halaman Produk

Menampilkan katalog produk yang diambil langsung dari database.

Informasi produk:
- Foto produk.
- Nama produk.
- Harga.
- Kategori.
- Deskripsi singkat.
- Tombol Lihat Detail.

Fitur:
- Menampilkan seluruh produk.
- Filter berdasarkan kategori.
- Pencarian berdasarkan nama produk.
- Pagination jika jumlah produk banyak.

### C. Halaman Detail Produk

Menampilkan informasi lengkap produk.

Informasi:
- Foto produk.
- Nama produk.
- Harga.
- Kategori.
- Deskripsi lengkap.
- Status ketersediaan.

Data harus diambil berdasarkan ID produk melalui route parameter.

### D. Halaman Tentang Kami

Menampilkan:
- Profil usaha.
- Sejarah singkat.
- Visi dan misi.
- Informasi kontak.
- Lokasi usaha.

# 5. ADMIN DASHBOARD

## 5.1 Login Administrator

Halaman login khusus administrator.

Fitur:
- Input email.
- Input password.
- Validasi login.
- Logout.
- Proteksi route menggunakan middleware authentication.

Pengunjung umum tidak boleh mengakses dashboard admin.

## 5.2 Dashboard

Menampilkan ringkasan:
- Total produk.
- Total kategori.
- Produk terbaru.
- Daftar produk terbaru yang ditambahkan.

Data statistik harus berasal dari database.

## 5.3 Manajemen Produk

Admin dapat melakukan CRUD produk.

### Create Product

Form tambah produk:
- Nama produk.
- Kategori.
- Harga.
- Deskripsi.
- Foto produk.
- Status ketersediaan.

### Read Product

Menampilkan daftar produk dalam tabel dengan:
- Foto.
- Nama produk.
- Kategori.
- Harga.
- Status.
- Aksi edit dan hapus.

### Update Product

Admin dapat memperbarui seluruh informasi produk dan mengganti foto.

Jika foto diganti, foto lama harus dihapus dari storage.

### Delete Product

Admin dapat menghapus produk.

Ketentuan:
- Tampilkan konfirmasi sebelum menghapus.
- Hapus file foto terkait dari storage.
- Hapus data produk dari database.

## 5.4 Manajemen Kategori

Admin dapat:
- Melihat kategori.
- Menambahkan kategori.
- Mengedit kategori.
- Menghapus kategori.

Kategori yang masih digunakan produk tidak boleh dihapus secara sembarangan. Berikan validasi atau pesan bahwa kategori masih digunakan.

# 6. DATABASE DESIGN

Gunakan PostgreSQL dengan minimal tiga tabel utama.

## 6.1 Tabel Users

Digunakan untuk autentikasi administrator.

| Field | Tipe |
|---|---|
| id | BIGINT |
| name | VARCHAR |
| email | VARCHAR UNIQUE |
| password | VARCHAR |
| created_at | TIMESTAMP |
| updated_at | TIMESTAMP |

## 6.2 Tabel Categories

| Field | Tipe |
|---|---|
| id | BIGINT |
| name | VARCHAR |
| slug | VARCHAR UNIQUE |
| description | TEXT NULL |
| created_at | TIMESTAMP |
| updated_at | TIMESTAMP |

## 6.3 Tabel Products

| Field | Tipe |
|---|---|
| id | BIGINT |
| category_id | BIGINT FOREIGN KEY |
| name | VARCHAR |
| slug | VARCHAR UNIQUE |
| price | BIGINT |
| description | TEXT |
| image | VARCHAR NULL |
| stock_status | VARCHAR |
| created_at | TIMESTAMP |
| updated_at | TIMESTAMP |

## 6.4 Database Relationship

Relasi database:

- Category memiliki banyak Product.
- Product dimiliki oleh satu Category.
- User digunakan untuk autentikasi administrator.

Eloquent relationship:

Category Model:
- `hasMany(Product::class)`

Product Model:
- `belongsTo(Category::class)`

Pengambilan data wajib melalui Controller menggunakan Eloquent ORM.

# 7. VALIDATION

Validasi dilakukan di sisi server menggunakan Laravel Validation.

## 7.1 Validasi Produk

| Field | Aturan |
|---|---|
| name | required, string, max:255 |
| category_id | required, exists:categories,id |
| price | required, numeric, min:1 |
| description | required, string |
| image | nullable, image, mimes:jpg,jpeg,png,webp, max:2048 |
| stock_status | required, in:available,sold_out |

## 7.2 Validasi Kategori

| Field | Aturan |
|---|---|
| name | required, string, max:100, unique |
| description | nullable, string, max:500 |

## 7.3 Validasi Login

- Email wajib diisi dan harus berformat email.
- Password wajib diisi.
- Kredensial harus sesuai dengan akun administrator.

Tampilkan pesan error yang jelas pada setiap field.

# 8. IMAGE UPLOAD

Fitur upload gambar produk menggunakan Laravel Storage.

Ketentuan:
- Format JPG, JPEG, PNG, dan WEBP.
- Maksimal ukuran 2 MB.
- Simpan gambar pada disk public.
- Path penyimpanan menggunakan `storage/app/public/products`.
- Gunakan `php artisan storage:link`.
- Gambar ditampilkan melalui URL storage.
- Nama file dibuat unik untuk menghindari konflik.
- Hapus gambar lama ketika foto produk diganti.

# 9. SEEDER & DUMMY DATA

Website wajib memiliki minimal 5 data produk.

Contoh kategori:

1. Kopi Lampung.
2. Keripik dan Camilan.
3. Sambal dan Makanan.
4. Oleh-Oleh Khas Lampung.

Contoh produk:

| Produk | Kategori |
|---|---|
| Kopi Robusta Lampung | Kopi Lampung |
| Kopi Bubuk Liwa | Kopi Lampung |
| Keripik Pisang Cokelat | Keripik dan Camilan |
| Keripik Pisang Original | Keripik dan Camilan |
| Sambal Lampung | Sambal dan Makanan |

Seeder juga harus membuat:
- Data kategori.
- Minimal 5 data produk.
- Satu akun administrator.

Gunakan password yang di-hash melalui Laravel Hash.

# 10. UI/UX DESIGN

## 10.1 Design Direction

Konsep desain: Modern Local Business / Modern Editorial.

Website harus memiliki identitas visual UMKM lokal yang modern, profesional, dan mudah digunakan.

### Color Palette

| Elemen | Warna |
|---|---|
| Primary | #166534 |
| Secondary | #14532D |
| Accent | #D97706 |
| Background | #FAFAF5 |
| Text | #1C1917 |
| Card | #FFFFFF |

### Typography

- Heading: Plus Jakarta Sans.
- Body: Inter.

### Public Website

Karakteristik:
- Hero section yang menarik.
- Navbar minimalis.
- Product card dengan gambar dominan.
- Rounded corners yang konsisten.
- Whitespace cukup.
- Hover transition.
- Responsive layout.
- Navigasi sederhana.

### Admin Dashboard

Karakteristik:
- Sidebar navigation.
- Topbar.
- Statistik berbentuk cards.
- Tabel produk.
- Form input yang rapi.
- Modal konfirmasi hapus.
- Toast notification.
- Responsive untuk desktop dan tablet.

# 11. PROJECT STRUCTURE

Struktur folder yang disarankan:

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── PublicController.php
│   │   ├── ProductController.php
│   │   ├── CategoryController.php
│   │   └── Admin/
│   │       └── DashboardController.php
│   └── Requests/
│       ├── StoreProductRequest.php
│       └── UpdateProductRequest.php
│
├── Models/
│   ├── User.php
│   ├── Product.php
│   └── Category.php
│
database/
├── migrations/
├── seeders/
│   ├── DatabaseSeeder.php
│   ├── CategorySeeder.php
│   ├── ProductSeeder.php
│   └── AdminSeeder.php
│
resources/
├── views/
│   ├── layouts/
│   │   ├── public.blade.php
│   │   └── admin.blade.php
│   ├── public/
│   │   ├── home.blade.php
│   │   ├── products.blade.php
│   │   ├── product-detail.blade.php
│   │   └── about.blade.php
│   ├── auth/
│   │   └── login.blade.php
│   └── admin/
│       ├── dashboard.blade.php
│       ├── products/
│       └── categories/
│
routes/
└── web.php
```

# 12. ROUTING

## Public Routes

| Method | URL | Fungsi |
|---|---|---|
| GET | / | Beranda |
| GET | /produk | Daftar produk |
| GET | /produk/{slug} | Detail produk |
| GET | /tentang | Tentang usaha |

## Authentication Routes

| Method | URL | Fungsi |
|---|---|---|
| GET | /login | Halaman login |
| POST | /login | Proses login |
| POST | /logout | Logout |

## Admin Routes

Semua route admin wajib menggunakan middleware auth.

| Method | URL | Fungsi |
|---|---|---|
| GET | /admin/dashboard | Dashboard |
| GET | /admin/products | Daftar produk |
| GET | /admin/products/create | Form produk |
| POST | /admin/products | Simpan produk |
| GET | /admin/products/{product}/edit | Edit produk |
| PUT | /admin/products/{product} | Update produk |
| DELETE | /admin/products/{product} | Hapus produk |
| GET | /admin/categories | Daftar kategori |
| POST | /admin/categories | Tambah kategori |
| PUT | /admin/categories/{category} | Update kategori |
| DELETE | /admin/categories/{category} | Hapus kategori |

# 13. SECURITY REQUIREMENTS

1. Password harus disimpan dalam bentuk hash.
2. Dashboard admin harus dilindungi middleware authentication.
3. Semua form menggunakan CSRF protection.
4. Validasi upload gambar dilakukan di server.
5. Gunakan mass assignment protection pada Model.
6. Jangan menyimpan password atau kredensial sensitif dalam source code.
7. Gunakan middleware untuk melindungi seluruh route admin.

# 14. ACCEPTANCE CRITERIA

Proyek dianggap selesai apabila seluruh kriteria berikut terpenuhi.

- [ ] Project Laravel berhasil dijalankan menggunakan `php artisan serve`.
- [ ] Database PostgreSQL berhasil terkoneksi.
- [ ] Migration berhasil dijalankan tanpa error.
- [ ] Minimal dua tabel memiliki relasi yang berfungsi.
- [ ] Model Eloquent memiliki relationship yang sesuai.
- [ ] Pengambilan data dilakukan melalui Controller.
- [ ] Homepage menampilkan informasi usaha.
- [ ] Halaman katalog mengambil produk dari database.
- [ ] Detail produk menampilkan data sesuai ID/slug.
- [ ] Admin dapat login dan logout.
- [ ] Admin dapat menambah produk.
- [ ] Admin dapat mengedit produk.
- [ ] Admin dapat menghapus produk.
- [ ] Admin dapat mengelola kategori.
- [ ] Upload foto produk berhasil.
- [ ] Foto tersimpan di public storage.
- [ ] Validasi server berjalan dengan benar.
- [ ] Tampilan responsive.
- [ ] Seeder menyediakan minimal 5 produk.
- [ ] Seluruh halaman berjalan tanpa error.

# 15. DEVELOPMENT PRIORITY

Urutan pengerjaan:

**Phase 1 — Project Setup**
- Membuat project Laravel.
- Konfigurasi PostgreSQL.
- Instalasi Tailwind CSS.
- Menyiapkan struktur folder.

**Phase 2 — Database**
- Membuat migration.
- Membuat Model.
- Membuat relationship.
- Membuat seeder.

**Phase 3 — Public Website**
- Membuat layout utama.
- Membuat homepage.
- Membuat katalog produk.
- Membuat detail produk.
- Membuat halaman tentang.

**Phase 4 — Admin Dashboard**
- Membuat autentikasi.
- Membuat dashboard.
- Membuat CRUD produk.
- Membuat CRUD kategori.
- Membuat upload gambar.

**Phase 5 — Testing**
- Menguji seluruh route.
- Menguji CRUD.
- Menguji relasi database.
- Menguji validasi.
- Menguji upload gambar.
- Menguji responsive layout.
- Memastikan tidak ada error.

# 16. PROJECT CONSTRAINTS

- Fokus pada pemenuhan seluruh persyaratan UTS.
- Tidak membutuhkan payment gateway.
- Tidak membutuhkan sistem transaksi atau checkout.
- Tidak membutuhkan integrasi AI.
- Tidak membutuhkan API eksternal.
- Tidak membutuhkan frontend SPA.
- Tidak membutuhkan deployment untuk tahap pengerjaan UTS.

**Prioritas utama adalah fungsionalitas Laravel, relasi database, CRUD, validasi, upload gambar, dan tampilan responsif.**

---

**FINAL DELIVERABLE:** Website katalog UMKM Rasa Lampung yang dinamis, menggunakan Laravel 12, Blade, Tailwind CSS 4, dan PostgreSQL, dengan halaman publik serta dashboard administrator yang seluruh datanya terhubung ke database.