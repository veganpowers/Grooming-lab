<<<<<<< HEAD
# Glowcut Barbershop

Aplikasi web berbasis Laravel untuk sistem barbershop dan beauty service dengan fitur login multi-role, dashboard admin, dashboard kasir, dan dashboard pelanggan.

## Fitur Utama

- Login multi-role: admin, kasir, pelanggan
- Dashboard terpisah untuk setiap role
- Middleware pembatas akses antar role
- Tema light dan dark untuk tampilan halaman
- UI landing login dan dashboard modern
- Seeder akun demo untuk testing

## Teknologi

- Laravel
- PHP
- MySQL / SQLite untuk testing
- Bootstrap 5
- Blade template

## Struktur Project

- `app/Http/Controllers` : controller aplikasi
- `app/Http/Middleware` : middleware akses per role
- `resources/views` : tampilan login dan dashboard
- `routes/web.php` : routing aplikasi
- `database/seeders` : data akun contoh
- `tests/Feature` : pengujian fitur

## Persiapan

Pastikan Anda sudah memiliki PHP, Composer, dan database yang siap.

1. Clone project
2. Install dependency

```bash
composer install
```

3. Siapkan environment

```bash
cp .env.example .env
php artisan key:generate
```

4. Konfigurasi database di file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=groominglabs
DB_USERNAME=root
DB_PASSWORD=
```

5. Buat database jika belum ada

```sql
CREATE DATABASE groominglabs;
```

6. Jalankan migrasi dan seed data

```bash
php artisan migrate --seed
```

Atau jika ingin reset database dari awal:

```bash
php artisan migrate:fresh --seed
```

## Menjalankan Aplikasi

```bash
php artisan serve
```

Buka URL:

```text
http://127.0.0.1:8000
```

## Akun Demo

Akun yang tersedia setelah seeding:

| Role | Email | Password |
| --- | --- | --- |
| Admin | admin@example.com | password |
| Kasir | kasir@example.com | password |
| Pelanggan | pelanggan@example.com | password |

## Route Utama

- `/` : halaman login
- `/dashboard/admin` : dashboard admin
- `/dashboard/kasir` : dashboard kasir
- `/dashboard/pelanggan` : dashboard pelanggan
- `/logout` : logout

## Testing

```bash
php artisan test
```

## Catatan

Project ini masih dalam tahap pengembangan fitur, namun struktur dasar autentikasi, role access, dan tema UI sedang dikembangkan lebih lanjut.

## Lisensi

Project ini dibuat untuk kebutuhan pembelajaran dan pengembangan internal.
=======
# TrimHaus Barbershop

Aplikasi booking barbershop berbasis Laravel dengan tiga role: **pelanggan**, **kasir**, dan **admin**.

## Yang Sudah Dibuat

- Login, logout, dan registrasi pelanggan berbasis session Laravel.
- Role-based access menggunakan middleware `role`.
- Dashboard pelanggan untuk melihat layanan, membuat booking, dan memantau status.
- Dashboard kasir/admin untuk melihat seluruh booking dan mengubah status menjadi confirmed, completed, atau cancelled.
- Validasi jadwal booking agar tidak ada dua booking aktif pada waktu yang sama.
- Migration dan relasi untuk `users`, `services`, dan `bookings`.
- Factory, seeder demo, UI responsif, dan feature test untuk alur penting.

## Role Dan Akses

| Role | Akses |
| --- | --- |
| Pelanggan | Registrasi, login, melihat layanan, membuat booking, melihat booking miliknya |
| Kasir | Login, melihat semua booking, mengubah status booking |
| Admin | Login, melihat semua booking, mengubah status booking |

## Menjalankan Aplikasi

1. Pastikan PHP 8.3+, Composer, Node.js, dan database tersedia.
2. Dari folder `Barbershop`, install dependency:

   ```bash
   composer install
   npm install
   ```

3. Siapkan `.env`, lalu buat application key:

   ```bash
   php artisan key:generate
   ```

4. Konfigurasikan database pada `.env`. Template memakai SQLite; pastikan ekstensi `pdo_sqlite` aktif, atau ubah `DB_CONNECTION` ke MySQL dan isi kredensialnya.
5. Jalankan migration dan data demo:

   ```bash
   php artisan migrate --seed
   ```

6. Build asset dan jalankan server:

   ```bash
   npm run build
   php artisan serve
   ```

   Buka `http://localhost:8000`.

## Akun Demo

Semua akun memakai password `password`:

| Role | Email |
| --- | --- |
| Admin | `admin@trimhaus.test` |
| Kasir | `kasir@trimhaus.test` |
| Pelanggan | `pelanggan@trimhaus.test` |

## Test

Test feature dapat dijalankan dengan:

```bash
php artisan test --compact
```

Test mencakup registrasi pelanggan, pembuatan booking, larangan pelanggan mengubah status, dan kemampuan kasir mengubah status. Jika memakai konfigurasi SQLite, PHP CLI harus memiliki ekstensi `pdo_sqlite`.

## Struktur Utama

- `app/Http/Controllers/AuthController.php`: login, registrasi, logout.
- `app/Http/Controllers/BookingController.php`: dashboard, pembuatan booking, dan status booking.
- `app/Http/Middleware/RoleMiddleware.php`: pembatasan akses berdasarkan role.
- `app/Models/Service.php` dan `app/Models/Booking.php`: domain layanan dan booking.
- `resources/views`: halaman login, registrasi, dan dashboard.
>>>>>>> bd5a20f55bf1875d192fdc9385ff71b0c9956405
