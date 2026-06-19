# PANDUAN DEPLOYMENT (PRODUCTION)
**SMART UMKM BALI**

Panduan teknis ini dirancang untuk melakukan proses *deployment* kode sumber (Source Code) Smart UMKM Bali ke *Virtual Private Server* (VPS) atau *Dedicated Server* Production.

**Spesifikasi Lingkungan Target:**
- **OS:** Ubuntu 24.04 LTS
- **Web Server:** Nginx
- **Engine:** PHP 8.3
- **Database:** MySQL 8

---

## 1. Persiapan Server (Instalasi Modul Dasar)

Masuk ke server menggunakan SSH dan jalankan pembaruan sistem. Instalasi seluruh paket yang dibutuhkan oleh Laravel dan sistem operasi.

```bash
# Update sistem
sudo apt update && sudo apt upgrade -y

# Instalasi Nginx, MySQL, dan utilitas dasar
sudo apt install -y nginx mysql-server git curl unzip supervisor

# Menambahkan PPA untuk PHP 8.3 (Ondrej Surý)
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update

# Instalasi PHP 8.3 dan ekstensinya
sudo apt install -y php8.3-fpm php8.3-mysql php8.3-mbstring php8.3-xml php8.3-curl \
                    php8.3-zip php8.3-bcmath php8.3-gd php8.3-intl php8.3-sqlite3

# Instalasi Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Instalasi Node.js (v20 LTS disarankan) dan NPM
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
```

---

## 2. Clone Repository

Pindahkan lokasi kerja Anda ke direktori `/var/www/` lalu *clone* repositori dari GitHub.

```bash
cd /var/www/

# Ganti URL ini dengan URL repositori Anda yang valid
sudo git clone https://github.com/ath16/smart-umkm-bali.git smart-umkm

# Mengatur izin kepemilikan agar dapat diakses Nginx dan pengguna Anda
sudo chown -R $USER:www-data /var/www/smart-umkm
sudo chmod -R 775 /var/www/smart-umkm/storage
sudo chmod -R 775 /var/www/smart-umkm/bootstrap/cache

cd smart-umkm
```

---

## 3. Composer Install

Unduh dan kompilasi seluruh dependensi *backend* (PHP) aplikasi untuk Production.

```bash
# Instalasi vendor PHP tanpa package dev dan optimasi autoloader
composer install --optimize-autoloader --no-dev
```

---

## 4. NPM Install

Unduh modul *frontend* (Node/Tailwind/Vite).

```bash
# Instalasi package frontend
npm install
```

---

## 5. Build Asset

Kompilasi aset CSS dan JavaScript (TailwindCSS & Alpine.js) melalui Vite agar siap digunakan di lingkungan *Production*.

```bash
# Kompilasi dan minifikasi aset statis
npm run build
```

---

## 6. Environment Setup (MySQL & Konfigurasi)

Salin fail `.env` dasar dan sesuaikan pengaturan basis data, sesi, dan API kunci.

```bash
cp .env.example .env

# Hasilkan APP_KEY baru yang aman
php artisan key:generate
```

Ubah konfigurasi berkas `.env` menggunakan editor teks (contoh: `nano .env`). Pastikan bagian berikut disesuaikan:

```env
APP_NAME="Smart UMKM Bali"
APP_ENV=production
APP_KEY=base64:...
APP_DEBUG=false
APP_URL=https://umkmbali.com  # Ubah sesuai domain Anda

# Konfigurasi MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smart_umkm_db
DB_USERNAME=root         # Sangat disarankan membuat user db khusus
DB_PASSWORD=your_secure_password

# Konfigurasi Queue untuk Laporan PDF dan Email
QUEUE_CONNECTION=database

# Konfigurasi Midtrans Payment Gateway
MIDTRANS_SERVER_KEY="SB-Mid-server-..."
MIDTRANS_IS_PRODUCTION=true
```

*(Siapkan basis datanya terlebih dahulu melalui shell MySQL)*:
```bash
sudo mysql -u root -p
# Di dalam shell MySQL:
# CREATE DATABASE smart_umkm_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
# EXIT;
```

---

## 7. Database Migration

Migrasikan seluruh struktur tabel basis data MySQL.

```bash
# Mengeksekusi migrasi tabel
php artisan migrate --force

# (Opsional) Jika Anda butuh data dummy/kategori dasar untuk permulaan
# php artisan db:seed --force
```

---

## 8. Queue Setup (Supervisor)

*Queue Worker* wajib aktif tanpa henti di belakang layar untuk memproses pembuatan ekspor laporan PDF (`GenerateReportPdfJob`) dan pengiriman Webhook.

Buat fail konfigurasi Supervisor baru:
```bash
sudo nano /etc/supervisor/conf.d/smart-umkm-worker.conf
```

Isi fail dengan teks berikut:
```ini
[program:smart-umkm-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/smart-umkm/artisan queue:work database --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/smart-umkm/storage/logs/worker.log
stopwaitsecs=3600
```

Terapkan pengaturan Supervisor:
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start smart-umkm-worker:*
```

---

## 9. Scheduler Setup (Cron)

Aktifkan Cron Job agar fitur penjadwalan (seperti suspensi otomatis, laporan bulanan, dsb) dapat tereksekusi.

Buka editor cron:
```bash
crontab -e
```

Tambahkan baris berikut di paling bawah:
```bash
* * * * * cd /var/www/smart-umkm && php artisan schedule:run >> /dev/null 2>&1
```

---

## 10. Konfigurasi Nginx & SSL Setup

Buat fail konfigurasi Server Block Nginx untuk aplikasi Anda.

```bash
sudo nano /etc/nginx/sites-available/smart-umkm
```

Isi fail dengan struktur berikut (Sesuaikan bagian `server_name`):
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name umkmbali.com www.umkmbali.com;
    root /var/www/smart-umkm/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php index.html index.htm;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Aktifkan konfigurasi Nginx dan muat ulang servis:
```bash
sudo ln -s /etc/nginx/sites-available/smart-umkm /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

**Instalasi SSL (Certbot Let's Encrypt):**
```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d umkmbali.com -d www.umkmbali.com
```
*(Ikuti petunjuk di layar, pilih opsi Redirect HTTP to HTTPS).*

---

## 11. Production Optimization

Langkah terakhir adalah melakukan pembersihan dan kompilasi *Cache* tingkat lanjut untuk memastikan responsivitas tercepat (*Lightning Fast*).

Jalankan perintah berikut di dalam direktori proyek (`/var/www/smart-umkm`):

```bash
# Hapus cache usang
php artisan optimize:clear

# Kompilasi Route, View, dan Configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimasi layanan Event (jika menggunakan broadcast/event discovery)
php artisan event:cache
```

> [!CAUTION]
> **Penyegaran Sistem:** Apabila di masa depan Anda melakukan modifikasi di fail `.env`, Anda **wajib** menjalankan `php artisan config:cache` kembali agar perubahan teraplikasikan.

---

Aplikasi **Smart UMKM Bali** Anda kini sudah 100% *Live* dan siap menerima transaksi dari ribuan UMKM di seluruh Pulau Dewata! 🚀
