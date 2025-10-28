# Sewa Angkot Turbo

## Informasi Kelompok
- **Nama Kelompok**: Turbo  
- **Nama Team**: Luis Fauzan Morgan  
- **Nama Project**: Sewa Angkot Turbo  

## Deskripsi Project
Sistem peminjaman angkot balap berbasis web menggunakan Laravel. Sistem ini punya 2 jenis user: Admin dan User, dengan fitur untuk mengelola peminjaman unit angkot.  

## Fitur Utama

### Authentication & Authorization
- Semua user wajib login  
- Role-based access (Admin vs User)  
- Registrasi user baru  
- Profile management (satu profile per user)  

### Manajemen Unit
- Setiap unit punya kode unik  
- Unit bisa punya 2 kategori  
- Cari unit berdasarkan nama  
- CRUD unit (Admin only)  

### Manajemen Kategori
- Kategori untuk mengelompokkan unit  
- CRUD kategori (Admin only)  

### Sistem Peminjaman
- User bisa meminjam maksimal 2 unit  
- Durasi peminjaman maksimal 5 hari  
- Denda otomatis kalau lewat batas  
- User cuma bisa lihat unit yang dipinjam  

### Manajemen User
- CRUD user (Admin only)  
- User bisa ubah profile sendiri  

### Riwayat Peminjaman
- Admin bisa lihat semua riwayat peminjaman  
- Admin bisa cetak laporan  
- User cuma bisa lihat riwayat peminjaman sendiri  

### Pengembalian Unit
- Hanya Admin yang bisa mengembalikan unit  
- User harus hubungi admin untuk pengembalian  

## Alur Website

### User
1. Registrasi/Login  
2. Dashboard: Browse Units, My Borrowings, Borrow Unit  
3. Browse Units: lihat daftar unit, cari unit, lihat detail  
4. Borrow Unit: pilih unit, isi form tanggal & durasi, validasi maksimal 2 unit aktif & durasi 5 hari  
5. My Borrowings: lihat unit yang dipinjam, status peminjaman, tidak bisa mengembalikan sendiri  
6. Profile: lihat & ubah profile, ubah password  

### Admin
1. Login  
2. Dashboard: Manage Users, Manage Categories, Manage Units, Manage Borrowings, View Histories  
3. Manage Users: lihat, tambah, edit, hapus user  
4. Manage Categories: lihat, tambah, edit, hapus kategori  
5. Manage Units: lihat, tambah, edit, hapus unit, atur kategori (maks 2)  
6. Manage Borrowings: lihat semua peminjaman, detail, pengembalian unit, hitung denda  
7. View Histories: lihat semua riwayat, cetak laporan  

## Teknologi
- Laravel 12  
- MySQL  
- Blade Templates + Tailwind CSS  
- Laravel Breeze untuk authentication  

## Struktur Database
- **users**: data user dan role  
- **profiles**: detail profile user  
- **categories**: kategori unit  
- **units**: data unit angkot  
- **unit_category**: pivot table unit-kategori  
- **borrowings**: peminjaman aktif  
- **borrowing_histories**: riwayat peminjaman  

## Validasi
- Semua field penting required  
- Email unik  
- Password minimal 8 karakter  
- Durasi peminjaman maksimal 5 hari  
- User maksimal 2 unit aktif  

## Error Handling
- Error validasi muncul di form  
- Redirect dengan flash message  
- Middleware untuk role-based access  
