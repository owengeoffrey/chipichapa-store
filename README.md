# ChipiChapa Store

Aplikasi Pendataan Barang berbasis web untuk PT ChipiChapa. Dibangun menggunakan Laravel 9 dengan Bootstrap 5.

## Fitur

### Admin
- Login admin terpisah
- CRUD barang (tambah, lihat, edit, hapus) dengan upload foto
- Kelola kategori dan stok barang

### User
- Register & login
- Lihat katalog barang
- Tambah barang ke keranjang belanja
- Checkout & buat faktur pembelian
- Cetak faktur (invoice)
- Riwayat faktur

## Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/owengeoffrey/chipichapa-store.git
   cd chipichapa-store
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Konfigurasi environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Buat database SQLite**
   ```bash
   touch database/database.sqlite
   ```
   Pastikan di file `.env`:
   ```
   DB_CONNECTION=sqlite
   ```

5. **Jalankan migrasi & seeder**
   ```bash
   php artisan migrate --seed
   ```

6. **Link storage untuk foto barang**
   ```bash
   php artisan storage:link
   ```

7. **Jalankan server**
   ```bash
   php artisan serve
   ```
   Buka `http://localhost:8000` di browser.

## Akun Demo

| Role  | Email              | Password   | URL Login        |
|-------|--------------------|------------|------------------|
| Admin | admin@gmail.com    | admin123   | `/admin/login`   |
| User  | user@gmail.com     | user123    | `/login`         |

## Cara Penggunaan

### Sebagai Admin
1. Buka `/admin/login` dan masuk dengan akun admin
2. Kelola barang: tambah barang baru, edit harga/stok, upload foto, atau hapus barang
3. Semua perubahan langsung terlihat di katalog user

### Sebagai User
1. Register akun baru atau login dengan akun demo
2. Buka **Katalog** untuk melihat daftar barang yang tersedia
3. Klik **Tambah ke Keranjang** pada barang yang ingin dibeli
4. Buka **Keranjang** untuk mengatur jumlah pesanan
5. Klik **Checkout & Buat Faktur**, isi alamat pengiriman dan kode pos
6. Faktur otomatis tersimpan dan bisa dicetak

## Tech Stack

- **Framework**: Laravel 9
- **PHP**: 8.x
- **Database**: SQLite
- **Frontend**: Bootstrap 5, Bootstrap Icons, Google Fonts (Inter)
