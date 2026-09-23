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
