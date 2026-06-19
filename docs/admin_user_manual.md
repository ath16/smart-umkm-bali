# DOKUMEN RESMI ADMINISTRATOR SISTEM
**SMART UMKM BALI – SUPERADMIN MANUAL**

*Dokumen ini bersifat rahasia dan dikhususkan bagi staf level Administrator yang memiliki kewenangan penuh (Superadmin) terhadap ekosistem platform Smart UMKM Bali.*

---

## 1. Login Admin (Otentikasi Superadmin)

**Tujuan:**
Mengakses panel kontrol tertinggi di dalam platform. Akses ini mengontrol seluruh *tenant* (toko) dan akun pelanggan dalam satu pintu.

**Prosedur Standar:**
1. Kunjungi rute khusus administratif (atau *login page* utama) platform.
2. Masukkan alamat email institusi/admin yang telah memiliki hak ases `role:admin`.
3. Masukkan kata sandi (Pastikan kerahasiaan kata sandi sangat dijaga).
4. Klik **"Masuk"**.
5. Sistem otorisasi akan membaca level akses. Jika hak akses tervalidasi sebagai Superadmin, Anda akan otomatis diteruskan ke rute terproteksi `/admin/dashboard`.

> [!CAUTION]
> **Peringatan Keamanan:** Dilarang keras membagikan kredensial login Admin ke pihak ketiga. Aktivitas Anda direkam secara sistem.

---

## 2. Dashboard Monitoring

**Tujuan:**
Melihat gambaran besar pergerakan seluruh entitas di dalam ekosistem (Toko, Pelanggan, Transaksi Global, dan Stabilitas Platform).

**Prosedur Standar:**
1. Setelah otentikasi berhasil, Anda akan mendarat di **Admin Dashboard**.
2. Anda akan disajikan dengan indikator makro (Macro Indicators):
   - **Total Toko Terdaftar** (Jumlah UMKM yang aktif).
   - **Total Pengguna** (Jumlah pelangan + kasir terdaftar).
   - **Total Transaksi** (Agregasi seluruh transaksi kotor antar *merchant*).
3. Anda dapat meninjau tabel **Aktivitas Terbaru** yang berisi log pendaftaran toko baru yang memerlukan perhatian (monitoring awal).

![Screenshot Admin Dashboard](/placeholder-admin-dashboard.png)

---

## 3. Kelola Toko (Tenant Management)

**Tujuan:**
Memantau seluruh mitra UMKM (*Merchants*) yang tergabung, meninjau informasi pemilik toko, dan memastikan tidak ada pelanggaran aturan.

**Prosedur Standar:**
1. Pada menu navigasi utama Admin, klik opsi **"Manajemen Toko"** (*Stores Management*).
2. Sistem akan menampilkan matriks *database* seluruh toko yang terdaftar di sistem beserta nama *Owner* terkait.
3. Anda dapat menggunakan filter pencarian untuk mencari toko spesifik berdasarkan nama, kategori, atau nama pemilik.
4. Klik ikon **"Lihat Detail"** (Mata) pada baris toko tertentu untuk memeriksa rincian mendalam (produk mereka, jumlah staf, dan ulasan pelanggan yang diterima).

![Screenshot Manajemen Toko](/placeholder-admin-kelola-toko.png)

---

## 4. Suspend Toko (Tindakan Disiplin)

**Tujuan:**
Membekukan aktivitas *tenant* UMKM apabila ditemukan pelanggaran (contoh: kecurangan produk, barang ilegal, laporan keluhan pengguna, dsb).

**Prosedur Standar:**
1. Masuk ke halaman **"Manajemen Toko"**.
2. Temukan toko yang terindikasi melakukan pelanggaran pedoman komunitas.
3. Pada baris toko tersebut, klik tombol **"Suspend"** (Ikon Gembok Merah).
4. Sebuah jendela peringatan (Dialog) akan muncul. Anda **wajib** mengisi alasan penangguhan (*Reason for Suspension*) agar terekam dalam *audit trail*.
5. Konfirmasi tindakan.
6. **Dampak Langsung:** 
   - Toko yang disuspend akan otomatis menghilang dari halaman pencarian (*Marketplace*).
   - Produk dari toko tersebut **tidak bisa** dimasukkan ke keranjang (*Checkout* diblokir total).
   - Pemilik toko (`Owner`) akan menerima tanda penangguhan saat *login*.
7. Untuk mencabut hukuman, klik tombol **"Unsuspend"** pada toko yang sama.

![Screenshot Penangguhan Toko](/placeholder-admin-suspend.png)

> [!WARNING]
> **Kebijakan Administratif:** Fitur suspensi bersifat langsung dan tanpa intervensi jeda waktu (langsung memotong akses database toko tersebut). Gunakan hanya berdasarkan keputusan investigasi yang sah.

---

## 5. Monitoring Aktivitas (Activity Logs)

**Tujuan:**
Meninjau *Audit Trail* atau jejak rekam sistem dari aktivitas pengguna untuk investigasi keamanan atau pelacakan *bug*.

**Prosedur Standar:**
1. Klik menu **"Log Aktivitas"** (*System Logs/Activities*).
2. Anda akan melihat log yang tercatat otomatis (Misal: *Login gagal*, *Pendaftaran sukses*, *Eksekusi Payment Gateway gagal*, dsb).
3. Untuk analisis forensik, Anda dapat memilah log berdasarkan tingkat keparahan (*Info, Warning, Error*).
4. Fitur ini sangat krusial saat Anda menerima keluhan tiket (*Support Ticket*) dari *Owner* atau pelanggan tentang transaksi yang bermasalah.

> [!TIP]
> **Praktik Terbaik:** Jika Anda melihat aktivitas mencurigakan dari alamat IP yang sama berkali-kali, segera tingkatkan pengawasan pada akun terkait.

---

## 6. Pengelolaan Sistem & Pengaturan

**Tujuan:**
Menyesuaikan konfigurasi global, seperti parameter komisi platform (jika ada), pengelolaan spanduk (*Banners/Hero*), serta artikel edukasi (*Blog*) resmi aplikasi.

**Prosedur Standar:**
1. **Pengaturan Artikel/Edukasi:** Navigasi ke menu **"Manajemen Artikel"**. Di sini Anda dapat memublikasikan artikel panduan UMKM atau berita platform yang akan muncul di *Landing Page* utama.
2. **Global Settings:** Bagian ini mungkin memuat konfigurasi kontak resmi dukungan (*Support Contact*) yang muncul pada *Footer* aplikasi, tautan sosial media resmi, hingga pemeliharaan struktur UI global.
3. Hindari mengubah pengaturan variabel konstan tanpa koordinasi teknis dengan pengembang (Developer) sistem, karena dapat memengaruhi tata letak *frontend* secara dinamis.

![Screenshot Pengaturan Sistem](/placeholder-admin-settings.png)

> [!IMPORTANT]
> **Penutup Dokumen:** Akses Superadmin adalah "Kunci Utama" seluruh infrastruktur Smart UMKM Bali. Segala tindakan pengubahan status (*Suspend/Update*) bersifat ireversibel secara operasional bisnis (*Real-time*). Selalu bertindak sesuai Standar Operasional Prosedur (SOP) Manajemen Perusahaan.
