# Panduan Pengguna (User Manual) – Pemilik Toko (Owner)
**Smart UMKM Bali**

Selamat datang di dasbor manajemen **Smart UMKM Bali**. Panduan ini dirancang khusus bagi Anda, para pengusaha UMKM, untuk memaksimalkan potensi penjualan Anda melalui ekosistem digital kami.

---

## 1. Registrasi Owner

**Tujuan:**
Membuat akun otoritas tertinggi (Owner) yang akan menjadi pengelola utama bisnis dan karyawan Anda di platform ini.

**Langkah:**
1. Buka halaman utama aplikasi Smart UMKM Bali.
2. Klik tombol **"Daftar"** di pojok kanan atas.
3. Masukkan **Nama Lengkap**, **Alamat Email**, dan **Kata Sandi** (minimal 8 karakter).
4. Klik tombol **"Daftar"**.
5. Setelah akun selesai dibuat dan terverifikasi, Anda siap untuk mendaftarkan nama bisnis/toko Anda di langkah selanjutnya.

> [!TIP]
> **Tips:** Gunakan email resmi bisnis Anda agar komunikasi pelanggan dan notifikasi sistem tidak tercampur dengan email pribadi.

---

## 2. Membuat Toko (Store Creation)

**Tujuan:**
Mendaftarkan unit usaha Anda ke dalam pasar digital (Marketplace) agar dapat mulai diakses oleh pelanggan.

**Langkah:**
1. Saat pertama kali masuk (Login), Anda akan diarahkan ke halaman penyambutan khusus untuk membuat toko. Klik **"Buka Toko Sekarang"**.
2. Masukkan **Nama Toko** Anda (Contoh: "Batik Asri Gianyar").
3. Isi **Kategori Usaha**, **Nomor Telepon Kontak**, dan **Alamat Lengkap Toko** secara fisik.
4. Tuliskan **Deskripsi Toko** yang menarik untuk memikat pelanggan.
5. Klik **"Simpan & Lanjutkan"**. Toko Anda kini telah resmi terdaftar!

> [!TIP]
> **Tips:** Tautan (URL/Slug) toko Anda akan otomatis dibuat berdasarkan Nama Toko. Pastikan nama mudah dieja dan diingat.

---

## 3. Dashboard Owner

**Tujuan:**
Memonitor "Kesehatan Bisnis" melalui indikator statistik tingkat tinggi secara *real-time*.

**Langkah:**
1. Setelah login, klik menu **"Dashboard"** pada panel navigasi di sebelah kiri.
2. Anda akan langsung melihat 4 kartu statistik utama:
   - **Total Pendapatan** (Rupiah yang dihasilkan).
   - **Total Pesanan** (Jumlah transaksi yang masuk).
   - **Produk Terjual** (Volume barang keluar).
   - **Total Pelanggan** (Jumlah orang yang pernah berbelanja).
3. Anda juga akan disuguhkan **Grafik Penjualan** untuk melacak tren mingguan atau bulanan.

![Screenshot Dashboard Owner](/placeholder-owner-dashboard.png)

> [!TIP]
> **Tips:** Jadikan halaman Dasbor ini sebagai layar pantauan pertama Anda setiap pagi untuk mengevaluasi strategi penjualan hari ini.

---

## 4. Kelola Produk

**Tujuan:**
Menambahkan, mengedit, dan menghapus barang dagangan yang akan dipajang di etalase toko.

**Langkah:**
1. Pada navigasi kiri, pilih menu **"Produk"**.
2. Klik tombol **"Tambah Produk Baru"**.
3. Isi informasi dasar: **Nama Produk**, **Deskripsi**, dan unggah **Foto Produk**.
4. Masukkan **Harga Beli/Modal (Cost Price)** dan **Harga Jual (Sell Price)**. *(Sistem akan otomatis menghitung estimasi margin keuntungan Anda).*
5. Klik **"Simpan"** untuk mempublikasikan produk tersebut.
6. Untuk mengubah data produk yang sudah ada, klik ikon pensil (Edit) pada baris produk bersangkutan.

![Screenshot Kelola Produk](/placeholder-owner-produk.png)

> [!WARNING]
> **Penting:** Pastikan harga diisi dengan teliti. Kesalahan pengetikan harga dapat merugikan bisnis Anda jika produk langsung dibeli pelanggan secara *online*.

---

## 5. Kelola Inventori (Stok Barang)

**Tujuan:**
Memastikan ketersediaan stok fisik sinkron dengan etalase digital untuk menghindari penolakan pesanan (*Out of Stock*).

**Langkah:**
1. Buka menu **"Produk"** dari panel navigasi.
2. Di tabel produk, perhatikan kolom **Stok Tersedia** dan **Batas Minimum Stok**.
3. Jika Anda mendapatkan kiriman barang baru dari *supplier*, klik tombol **"Edit"** pada produk tersebut.
4. Perbarui kolom **Stok**.
5. Tentukan **Batas Minimum Stok** (Contoh: 5). Sistem akan memberi penanda warna merah muda jika stok barang sudah menyentuh batas ini, memberi peringatan visual agar Anda segera merestok barang.
6. Klik **"Simpan"**.

> [!TIP]
> **Tips:** Fitur *Negative Inventory Blocking* otomatis aktif. Pelanggan tidak akan bisa memesan melebihi stok yang Anda tuliskan.

---

## 6. Kelola Kasir (Staff Management)

**Tujuan:**
Memberikan akses terbatas kepada karyawan (Kasir) Anda untuk memproses penjualan di titik toko fisik (Point of Sale/POS) tanpa memberikan akses ke laporan finansial.

**Langkah:**
1. Di panel kiri, klik menu **"Staf/Kasir"**.
2. Klik tombol **"Tambah Staf Baru"**.
3. Masukkan **Nama Karyawan**, **Email**, dan **Kata Sandi Semntara**.
4. Secara otomatis sistem akan menempatkan karyawan tersebut pada peran `Cashier` (Kasir) dan mengaitkannya ke toko Anda.
5. Klik **"Simpan"**.
6. Staf Anda kini bisa login menggunakan email tersebut untuk mengakses khusus fitur POS.

> [!IMPORTANT]
> **Keamanan:** Akun dengan peran `Cashier` **tidak akan pernah bisa** mengakses menu *Dashboard* utama Anda, tidak bisa melihat Laporan Finansial, dan tidak bisa menghapus produk.

---

## 7. Kelola Pesanan (Order Fulfillment)

**Tujuan:**
Melacak dan memproses pesanan masuk dari pembeli *online* (Marketplace).

**Langkah:**
1. Buka menu **"Pesanan"** (*Orders*) pada panel navigasi.
2. Anda akan melihat daftar pesanan yang difilter ke dalam beberapa tab: *Pesanan Baru*, *Diproses*, *Dikirim*, dan *Selesai*.
3. Buka pesanan dengan status **"Pesanan Baru"**.
4. Periksa detail pesanan (alamat pengiriman, produk, kurir ekspedisi).
5. Setelah paket siap dikirim, ubah **Status Pesanan** menjadi **"Dikirim"**.
6. (Jika ada), Anda dapat memasukkan Nomor Resi Kurir pada kolom pelacakan pengiriman.
7. Pelanggan akan secara otomatis menerima notifikasi bahwa pesanan mereka sedang dalam perjalanan.

![Screenshot Kelola Pesanan](/placeholder-owner-pesanan.png)

> [!TIP]
> **Tips:** Segera konfirmasi "Pesanan Baru" untuk meningkatkan metrik kepercayaan pelanggan terhadap toko Anda!

---

## 8. Laporan Penjualan (Reports)

**Tujuan:**
Meninjau performa finansial dan mengunduh laporan penjualan terperinci untuk evaluasi akuntansi.

**Langkah:**
1. Pada menu navigasi utama, klik **"Laporan"** (*Reports*).
2. Sistem akan menampilkan filter periode laporan. Pilih salah satu:
   - **Harian** (*Daily*)
   - **Mingguan** (*Weekly*)
   - **Bulanan** (*Monthly*)
3. Anda dapat melihat rangkuman transaksi (Baik dari Penjualan POS *Offline* maupun pemesanan *Marketplace* Online).
4. Untuk menyimpan atau mencetak bukti pembukuan, klik tombol merah **"Cetak PDF"**.
5. Sistem akan memproses data Anda di latar belakang (*Queue*) dan otomatis mengunduh fail berekstensi `.pdf` ke komputer Anda.

![Screenshot Laporan Penjualan](/placeholder-owner-laporan.png)

> [!TIP]
> **Tips:** Biasakan untuk mengunduh laporan secara periodik (Misalnya: Setiap akhir bulan) sebagai arsip manajemen keuangan yang disiplin.
