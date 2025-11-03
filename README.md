# Sewa Angkot Turbo

## Informasi Kelompok
- **Nama Kelompok**: Turbo
- **Nama Team**: Luis Fauzan Morgan
- **Nama Project**: Sewa Angkot Turbo

## Deskripsi Project
Sistem peminjaman angkot balap berbasis web yang dibangun dengan Laravel. Sistem ini memiliki 2 jenis user: Admin dan User (anggota), dengan fitur-fitur untuk mengelola peminjaman unit angkot.

## Fitur Utama

### 1. Authentication & Authorization
- Login wajib untuk semua user
- Role-based access control (Admin vs User)
- Registrasi user baru
- Profile management (satu profile per user)

### 2. Manajemen Unit
- Setiap unit memiliki kode unik
- Unit dapat memiliki multiple kategori (maksimal 2 kategori)
- Pencarian unit berdasarkan nama
- CRUD unit (Admin only)

### 3. Manajemen Kategori
- Kategori untuk mengelompokkan unit
- CRUD kategori (Admin only)

### 4. Sistem Peminjaman
- User dapat meminjam maksimal 2 unit
- Durasi maksimal peminjaman 5 hari
- Denda otomatis jika melebihi 5 hari
- User hanya dapat melihat unit yang dipinjamnya

### 5. Manajemen User
- CRUD user (Admin only)
- User dapat mengubah profile sendiri

### 6. Riwayat Peminjaman
- Admin dapat melihat semua riwayat peminjaman
- Admin dapat mencetak riwayat peminjaman
- User hanya dapat melihat riwayat peminjamannya sendiri

### 7. Pengembalian Unit
- Hanya Admin yang dapat melakukan pengembalian unit
- User harus menghubungi admin untuk pengembalian

## Alur Website

### Alur User (Anggota):
1. **Registrasi/Login**
   - User mendaftar sebagai anggota
   - Login dengan email dan password

2. **Dashboard User**
   - Melihat tombol navigasi: Browse Units, My Borrowings, Borrow Unit

3. **Browse Units**
   - Melihat daftar semua unit yang tersedia
   - Dapat mencari unit berdasarkan nama
   - Melihat detail unit (nama, kode, kategori, deskripsi)

4. **Borrow Unit**
   - Memilih unit yang ingin dipinjam
   - Mengisi form peminjaman (tanggal mulai, durasi)
   - Validasi: maksimal 2 unit aktif, durasi maksimal 5 hari

5. **My Borrowings**
   - Melihat daftar unit yang sedang dipinjam
   - Melihat status peminjaman (aktif/terlambat)
   - Tidak dapat mengembalikan unit sendiri

6. **Profile Management**
   - Melihat dan mengubah informasi profile
   - Mengubah password

### Alur Admin:
1. **Login**
   - Login sebagai admin (admin@example.com / password)

2. **Dashboard Admin**
   - Melihat tombol navigasi: Manage Users, Manage Categories, Manage Units, Manage Borrowings, View Histories

3. **Manage Users**
   - Melihat daftar semua user
   - Menambah, mengedit, menghapus user
   - Melihat detail user

4. **Manage Categories**
   - Melihat daftar kategori
   - Menambah, mengedit, menghapus kategori

5. **Manage Units**
   - Melihat daftar unit
   - Menambah, mengedit, menghapus unit
   - Mengatur kategori unit (maksimal 2 kategori per unit)

6. **Manage Borrowings**
   - Melihat semua peminjaman aktif
   - Melihat detail peminjaman
   - Melakukan pengembalian unit
   - Menghitung denda jika terlambat

7. **View Histories**
   - Melihat semua riwayat peminjaman
   - Mencetak laporan riwayat

## Teknologi yang Digunakan
- **Framework**: Laravel 12
- **Database**: MySQL
- **Frontend**: Blade Templates, Tailwind CSS
- **Authentication**: Laravel Breeze

## Instalasi dan Setup

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL

### Langkah Instalasi
1. Clone repository
2. Install dependencies: `composer install`
3. Copy environment file: `cp .env.example .env`
4. Generate app key: `php artisan key:generate`
5. Setup database di `.env`
6. Run migrations: `php artisan migrate`
7. Seed database: `php artisan db:seed`
8. Install frontend dependencies: `npm install`
9. Build assets: `npm run build`
10. Start server: `php artisan serve`

### Akun Default
- **Admin**: admin@example.com / password
- **User**: user1@example.com / password (dan lainnya)

## Struktur Database
- **users**: Data user dengan role
- **profiles**: Profile lengkap user
- **categories**: Kategori unit
- **units**: Data unit angkot
- **unit_category**: Pivot table untuk many-to-many relationship
- **borrowings**: Data peminjaman aktif
- **borrowing_histories**: Riwayat peminjaman

## Validasi
- Semua field penting memiliki validasi required
- Email unik
- Password minimal 8 karakter
- Durasi peminjaman maksimal 5 hari
- User maksimal 2 unit aktif

## Error Handling
- Pesan error validasi ditampilkan di form
- Redirect dengan flash message untuk feedback
- Middleware untuk role-based access control
