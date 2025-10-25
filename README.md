<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="360" alt="Laravel Logo"></a></p>

<p align="center">
<a href="#"> <img src="https://img.shields.io/badge/php-%3E%3D8.2-8892BF" alt="PHP"></a>
<a href="#"> <img src="https://img.shields.io/badge/laravel-^12.0-FF2D20" alt="Laravel"></a>
<a href="#"> <img src="https://img.shields.io/badge/license-MIT-44cc11" alt="License"></a>
<a href="#"> <img src="https://img.shields.io/badge/build-pending-lightgrey" alt="Build Status"></a>
</p>

# Web2_UAS-C-SAPP-

Project sederhana berbasis Laravel yang berfungsi sebagai platform pembelajaran dan forum. Repositori ini berisi implementasi Laravel dengan fitur modul pembelajaran, kuis, forum, profil pengguna, dan notifikasi.

Ringkasan singkat:

- Bahasa / Framework: PHP (>= 8.2), Laravel ^12
- Frontend: Tailwind CSS, Alpine.js, Vite
- Database: MySQL / SQLite (konfigurasi via .env)

## Fitur Utama

- Autentikasi pengguna
- Forum (topik & balasan)
- Modul pembelajaran dan progress
- Kuis dan hasil kuis
- Notifikasi dan preferensi notifikasi
- Export/print dengan DOMPDF

## Persyaratan

- PHP >= 8.2
- Composer
- Node.js & npm
- Database (MySQL / MariaDB / SQLite)

## Instalasi (pengembangan)

Ikuti langkah berikut untuk menjalankan proyek ini secara lokal:

```powershell
# 1. clone repository
git clone <repo-url> web2_uas
cd web2_uas

# 2. install dependencies
composer install
npm install

# 3. salin environment dan generate key
cp .env.example .env
php artisan key:generate

# 4. sesuaikan .env (database, mail, dll). Jika ingin cepat, gunakan sqlite:
# touch database/database.sqlite
# lalu set DB_CONNECTION=sqlite di .env

# 5. jalankan migrasi dan seeder (opsional)
php artisan migrate --seed

# 6. jalankan development server dan vite
npm run dev
php artisan serve --host=127.0.0.1 --port=8000
```

Setelah itu buka http://127.0.0.1:8000 di browser.

## Menjalankan test

Project ini menggunakan Pest / PHPUnit untuk testing. Jalankan:

```powershell
php artisan test
```

atau

```powershell
composer test
```

## Notes & Tips

- Jika Anda membuat perubahan pada view atau konfigurasi Tailwind, bersihkan cache dan rebuild assets:

```powershell
php artisan view:clear
php artisan config:clear
npm run build
```

- Untuk environment Windows/Laragon: pastikan service database berjalan dan konfigurasi `.env` sesuai (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).

## Struktur Proyek (ringkas)

- `app/` - kode aplikasi (Models, Http/Controllers, Helpers)
- `resources/views/` - Blade templates
- `routes/` - definisi rute (web.php, api.php)
- `database/` - migrasi, seeders, factories
- `public/` - assets publik dan index.php

## Kontribusi

Silakan buka issue untuk bug atau fitur baru. Jika ingin berkontribusi dengan PR, ikuti langkah berikut:

1. Fork repository
2. Buat branch baru: `git checkout -b feature/namafitur`
3. Commit perubahan dan push
4. Buat Pull Request dengan deskripsi perubahan

Pastikan:
- Menjalankan test lokal
- Menjaga gaya kode (Pint) jika ada

## Lisensi

Proyek ini dilisensikan di bawah MIT. Lihat file `LICENSE` untuk detail.

---

Jika Anda ingin saya menambahkan badge CI/GitHub Actions, dokumentasi versi atau contoh screenshot aplikasi, beri tahu URL repo GitHub atau file tambahan yang ingin dimasukkan.
