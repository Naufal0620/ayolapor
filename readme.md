# AyoLapor

AyoLapor adalah aplikasi web sistem pengaduan layanan publik yang berfokus pada pelaporan jalan rusak. Aplikasi ini menghubungkan masyarakat (Pelapor), Petugas Lapangan, dan Administrator Dinas dalam satu ekosistem terintegrasi.

Dibangun menggunakan Framework **CodeIgniter 3**, aplikasi ini mendukung fitur Geolocation (Peta), bukti laporan *Before-After*, dan antarmuka *Mobile-First* khusus untuk petugas lapangan.

## Fitur Unggulan

### Pelapor (Masyarakat)
- **Landing Page Modern:** Halaman depan informatif dengan navigasi mudah.
- **Lapor via Peta:** Menggunakan LeafletJS untuk titik koordinat akurat (GPS).
- **Riwayat Transparan:** Memantau status laporan (Pending, Proses, Selesai, Tolak).
- **Bukti Pengerjaan:** Melihat foto "Sebelum" dan "Sesudah" perbaikan jalan.

### Petugas Lapangan
- **Mobile-First Design:** Tampilan seperti aplikasi native (App-like) khusus smartphone.
- **Task Management:** Menerima tugas perbaikan secara *real-time*.
- **Navigasi Rute:** Integrasi langsung ke Google Maps untuk menuju lokasi.
- **Lapor Selesai:** Upload foto bukti perbaikan untuk menyelesaikan tugas.

### Administrator
- **Dashboard AdminLTE:** Tampilan admin yang profesional dan responsif.
- **Verifikasi Laporan:** Validasi laporan masuk (Terima/Tolak).
- **Manajemen User:** Mengelola akun petugas dan pengguna.

## Persyaratan Sistem

Pastikan server lokal Anda memenuhi syarat berikut:
- PHP versi 7.4 atau 8.x
- MySQL / MariaDB Database
- Web Server (Apache/Nginx)
- Browser dengan dukungan Javascript & GPS aktif

## Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan projek di lokal (XAMPP/Laragon):

### 1. Clone & Pindahkan Folder
Download atau clone repositori ini, lalu pindahkan ke folder `htdocs` Anda.

```bash
git clone https://github.com/Naufal0620/ayolapor.git
# Pindahkan folder hasil clone ke: C:\xampp\htdocs\ayolapor atau C:\laragon\www\ayolapor
```
### 2. Konfigurasi Base URL
Buka file ``application/config/config.php`` dan sesuaikan ``base_url``:
```php
$config['base_url'] = 'http://localhost/ayolapor/';
```

### 3. Konfigurasi Database
- Buka **phpMyAdmin** (http://localhost/phpmyadmin).
- Buat database baru dengan nama ``db_ayolapor``.
- Import file ``db_ayolapor.sql`` yang ada di dalam root folder projek ini.

### 4. Konfigurasi Environment (.env)
Aplikasi ini menggunakan file ``.env`` untuk konfigurasi database agar lebih aman.
Buat file baru bernama ``.env`` di root folder (sejajar dengan index.php), lalu isi dengan konfigurasi berikut:
```
DB_HOSTNAME=localhost
DB_USERNAME=root
DB_PASSWORD=
DB_DATABASE=db_ayolapor
DB_CONNECTION=mysqli
```

*(Sesuaikan DB_USER dan DB_PASS dengan settingan MySQL lokal Anda).*

### 5. Buat Folder Upload (Jika belum ada)
Pastikan folder berikut tersedia agar upload gambar berjalan lancar:

- ``uploads/foto_bukti``
- ``uploads/foto_bukti_selesai``

## Akun Default (Demo)

Gunakan akun berikut untuk pengujian awal:

**Administrator**
- Email: ``admin@ayolapor.com``
- Password: ``admin``

**User / Pelapor**
- Silakan daftar akun baru melalui menu "Daftar" di halaman utama.

## Struktur Folder
```
ayolapor/
├── application/
│   ├── controllers/    (Auth, Admin, Petugas, Users, Beranda)
│   ├── models/         (M_auth, M_users, M_petugas, dll)
│   └── views/          (Tampilan User, Mobile View Petugas, AdminLTE)
├── assets/
│   ├── dist/           (CSS/IMG Custom)
│   └── libjs/          (Logic Javascript terpisah per modul)
└── uploads/            (Folder penyimpanan bukti foto)
```

# Dibuat oleh

Dikembangkan oleh **PSIK 25 A Kelompok 3 Logika Informatika** sebagai projek sistem informasi layanan masyarakat.