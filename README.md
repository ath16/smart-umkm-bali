# Smart UMKM Bali

**Smart UMKM Bali** adalah platform *Marketplace* digital komprehensif yang dirancang untuk memberdayakan Usaha Mikro, Kecil, dan Menengah (UMKM) di wilayah Provinsi Bali. Sistem ini mengintegrasikan etalase produk *online* (*Marketplace*), manajemen inventori dan kasir (*Point of Sale/POS*), serta pelaporan penjualan dalam satu ekosistem (*Omnichannel*).

Platform ini dibangun menggunakan arsitektur monolit modern berbasis **Laravel 12** (*PHP 8.3*) dan antarmuka dinamis **TailwindCSS + Alpine.js**.

---

## 🚀 Fitur Utama

- **Multi-Tenant Architecture:** Satu platform untuk menampung ribuan UMKM secara independen.
- **Marketplace Customer:** Pelanggan dapat mencari produk lokal, mengelola keranjang, dan melakukan *checkout* pesanan gabungan antar toko.
- **Point of Sale (POS):** Kasir di toko fisik dapat mencatat transaksi *offline*, dan sistem secara otomatis menyeimbangkan stok gudang secara *real-time*.
- **Role-Based Access Control:** Pembatasan ketat antara `Customer`, `Owner` (Pemilik UMKM), `Cashier` (Karyawan), dan `Admin` (Pengelola Sistem).
- **Payment Gateway Integration:** Sinkronisasi pembayaran otomatis dengan **Midtrans** (*Webhook*).
- **Automated Reporting:** Ekspor PDF (*Queue-based*) dan laporan finansial interaktif.

---

## 📚 Dokumentasi Resmi (Buku Panduan)

Seluruh panduan teknis, langkah operasional, dan laporan tinjauan teknis (*Audit*) tidak ditumpuk pada fail README ini. Kami telah menyediakan direktori khusus `docs/` yang berisi dokumentasi komprehensif dalam format *Markdown*. 

Silakan merujuk pada fail-fail berikut:

- **[Panduan Pelanggan (Customer Manual)](docs/customer_user_manual.md):** Petunjuk bagi pembeli mengenai cara mencari produk, mendaftar, dan menyelesaikan transaksi.
- **[Panduan Pemilik Toko (Owner Manual)](docs/owner_user_manual.md):** Petunjuk manajemen operasional toko, penambahan kasir, produk, dan laporan penjualan.
- **[Panduan Administrator (Admin Manual)](docs/admin_user_manual.md):** Petunjuk manajemen kontrol sistem, moderasi toko (*Suspend*), dan pemantauan aktivitas.
- **[Panduan Peluncuran (Deployment Guide)](docs/deployment_guide.md):** Instruksi konfigurasi peladen (*Server*) Production berbasis Ubuntu, Nginx, PHP 8.3, dan MySQL 8.
- **[Tinjauan Kesiapan Akhir (Soft Launch Review)](docs/soft_launch_readiness_review.md):** Hasil asesmen teknis mutakhir yang mensertifikasi kesiapan sistem.

---

## 💻 Instalasi Lokal (Development)

Untuk menjalankan proyek ini secara lokal, ikuti instruksi standar berikut:

1. Kloning repositori:
   ```bash
   git clone https://github.com/ath16/smart-umkm-bali.git
   cd smart-umkm-bali
   ```
2. Salin dan konfigurasikan *Environment*:
   ```bash
   cp .env.example .env
   ```
3. Unduh dependensi:
   ```bash
   composer install
   npm install
   ```
4. Buat kunci aplikasi dan jalankan migrasi:
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```
5. Kompilasi aset dan jalankan peladen *development*:
   ```bash
   npm run dev
   php artisan serve
   ```

---

## 🔒 Lisensi & Keamanan

Perangkat lunak ini dikembangkan secara tertutup untuk kebutuhan sistem akademik / bisnis yang diproteksi. 

Jika menemukan celah keamanan (*Vulnerability*), harap langsung hubungi tim pengembang (*Superadmin*), tidak melaporkannya di *Issue Tracker* publik.
