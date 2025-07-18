
# 🎯 UAS Genap 2025 – Katalog Produk Laravel

Ini adalah **repository baru** untuk proyek Laravel _Katalog Produk dan Pemesanan_ yang merupakan bagian dari tugas UAS Genap 2025. Repo ini dibuat ulang berdasarkan versi sebelumnya yang mengalami masalah pada struktur dan dependensi. Seluruh logika program, tampilan (Blade), dan konfigurasi penting telah dipindahkan dan disusun ulang dengan lebih rapi di sini.

---

## 🔍 Deskripsi Proyek

Proyek ini adalah sebuah sistem **katalog produk berbasis Laravel** yang mendukung fitur:

- 🛍️ Melihat dan menelusuri produk
- ❤️ Wishlist (favorit)
- 🛒 Pemesanan produk (orders)
- ✍️ Ulasan produk
- 🔒 Autentikasi user dan admin
- 📊 Dashboard admin (statistik pengguna, produk, dan pesanan)
- 🎯 Role management (admin & user)
- 🌐 Backend siap untuk dihubungkan dengan frontend atau REST API

---

## 🧱 Teknologi yang Digunakan

- **Laravel Framework v12**
- **PostgreSQL** (Supabase sebagai backend DB)
- **Blade Templating**
- **Bootstrap 5**
- **Vercel Deployment (serverless via PHP runtime)**

---

## 🚀 Deployment

Proyek ini dirancang agar dapat dideploy ke **Vercel** menggunakan pendekatan serverless PHP.

### Struktur Folder Utama:
```
/public       => Entry point utama (index.php)
    ...
/resources/views  => Blade templates
/routes/web.php   => Routing utama Laravel
/vercel.json      => Konfigurasi untuk Vercel
```

> Untuk deployment ke Vercel, pastikan file `vercel.json` telah disesuaikan dan environment variables diatur sesuai konfigurasi `.env`.

---

## ⚙️ Konfigurasi Awal (Developer)

```bash
# Clone repository
git clone https://github.com/Hugo343/uas-genap-2025-2314370177-v2
cd repo-baru

# Install dependencies
composer install
npm install && npm run dev

# Buat file .env baru dan sesuaikan dengan Supabase/DB Anda
cp .env.example .env
php artisan key:generate

# Jalankan migration dan seeder (opsional)
php artisan migrate --seed

# Jalankan server lokal
php artisan serve
```

---

## 📂 Asal-Usul Repository

> 📝 Catatan:  
> Repo ini adalah hasil migrasi **penuh** dari repository sebelumnya (https://github.com/Hugo343/uas-genap-2025-2314370177) karena kendala pada dependency Laravel dan struktur folder. Semua logic dan view disalin ulang secara hati-hati ke dalam struktur Laravel yang lebih stabil dan sesuai standar.

---

## 📧 Kontak

> **Hugo Gabriel Sianturi**  
> Mahasiswa Sistem Komputer  
> Universitas Pembangunan Panca Budi
> Email: gogabriel2003@gmail.com

---

## 📄 Lisensi

Proyek ini dibuat sebagai tugas akademik dan tidak dimaksudkan untuk penggunaan komersial tanpa izin.
