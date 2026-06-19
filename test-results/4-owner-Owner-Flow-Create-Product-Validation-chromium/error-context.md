# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: 4-owner.spec.ts >> Owner Flow >> Create Product Validation
- Location: tests/e2e/4-owner.spec.ts:30:3

# Error details

```
Error: expect(page).toHaveURL(expected) failed

Expected pattern: /\/dashboard\/products\/create/
Received string:  "http://127.0.0.1:8000/"
Timeout: 5000ms

Call log:
  - Expect "toHaveURL" with timeout 5000ms
    13 × unexpected value "http://127.0.0.1:8000/"

```

```yaml
- navigation:
  - link "S Smart UMKM Bali":
    - /url: http://127.0.0.1:8000
  - link "Beranda":
    - /url: http://127.0.0.1:8000
  - link "Toko":
    - /url: http://127.0.0.1:8000/store
  - link "Produk":
    - /url: http://127.0.0.1:8000/products
  - link "Cerita":
    - /url: http://127.0.0.1:8000/blog
  - link "Tentang":
    - /url: http://127.0.0.1:8000/tentang-kami
  - img
  - textbox "Cari produk..."
  - link "Masuk":
    - /url: http://127.0.0.1:8000/login
  - link "Daftar":
    - /url: http://127.0.0.1:8000/register
- main:
  - img "Pengrajin Bali"
  - paragraph: Marketplace Premium UMKM Bali
  - heading "Karya Tangan Bali, Untuk Dunia" [level=1]:
    - text: Karya Tangan Bali,
    - emphasis: Untuk Dunia
  - paragraph: Setiap produk menyimpan cerita warisan budaya ribuan tahun — dari tangan pengrajin langsung ke tangan Anda.
  - link "Jelajahi Koleksi":
    - /url: http://127.0.0.1:8000/products
    - text: Jelajahi Koleksi
    - img
  - link "Temui Pengrajin":
    - /url: http://127.0.0.1:8000/store
  - text: Scroll
  - img
  - paragraph: Pilihan Terbaik
  - heading "Produk Unggulan" [level=2]
  - link "Lihat Semua":
    - /url: http://127.0.0.1:8000/products
    - text: Lihat Semua
    - img
  - link "Makanan Pie Susu Bali Premium (1 Kotak) Warung Kopi Bali Wayan Rp35.000":
    - /url: http://127.0.0.1:8000/products/pie-susu-bali-premium-1-kotak
    - img
    - paragraph: Makanan
    - heading "Pie Susu Bali Premium (1 Kotak)" [level=3]
    - paragraph: Warung Kopi Bali Wayan
    - paragraph: Rp35.000
  - link "Makanan Kacang Kapri Tari Bali Warung Kopi Bali Wayan Rp25.000":
    - /url: http://127.0.0.1:8000/products/kacang-kapri-tari-bali
    - img
    - paragraph: Makanan
    - heading "Kacang Kapri Tari Bali" [level=3]
    - paragraph: Warung Kopi Bali Wayan
    - paragraph: Rp25.000
  - link "Minuman Es Kopi Susu Gula Aren Warung Kopi Bali Wayan Rp22.000":
    - /url: http://127.0.0.1:8000/products/es-kopi-susu-gula-aren
    - img
    - paragraph: Minuman
    - heading "Es Kopi Susu Gula Aren" [level=3]
    - paragraph: Warung Kopi Bali Wayan
    - paragraph: Rp22.000
  - link "Minuman Kopi Bali Kintamani 250g Warung Kopi Bali Wayan Rp65.000":
    - /url: http://127.0.0.1:8000/products/kopi-bali-kintamani-250g
    - img
    - paragraph: Minuman
    - heading "Kopi Bali Kintamani 250g" [level=3]
    - paragraph: Warung Kopi Bali Wayan
    - paragraph: Rp65.000
  - link "Minuman Kopi Arabica Plaga 200g Warung Kopi Bali Wayan Rp85.000":
    - /url: http://127.0.0.1:8000/products/kopi-arabica-plaga-200g
    - img
    - paragraph: Minuman
    - heading "Kopi Arabica Plaga 200g" [level=3]
    - paragraph: Warung Kopi Bali Wayan
    - paragraph: Rp85.000
  - img "Warisan Budaya Bali"
  - text: Warisan Budaya
  - heading "Setiap Karya Menyimpan Cerita" [level=2]:
    - text: Setiap Karya Menyimpan
    - emphasis: Cerita
  - paragraph: Di balik setiap produk UMKM Bali terdapat warisan budaya ribuan tahun — teknik tenun yang diajarkan turun-temurun, ukiran kayu yang mengisahkan mitologi Hindu, dan aroma rempah yang menjadi identitas pulau dewata.
  - paragraph: Smart UMKM Bali hadir untuk memastikan cerita-cerita ini tidak hanya lestari, tetapi juga diapresiasi oleh dunia.
  - link "Baca Cerita Lengkap":
    - /url: http://127.0.0.1:8000/blog
    - text: Baca Cerita Lengkap
    - img
  - paragraph: Toko Terpilih
  - heading "Toko Favorit" [level=2]
  - paragraph: Temukan dan dukung pengrajin lokal terbaik dari seluruh pelosok Bali.
  - link "W Warung Kopi Bali Wayan Kuliner Warung kopi tradisional Bali dengan sentuhan modern, menyajikan kopi khas Kintamani dan makanan ringan lokal dengan cita rasa otentik.":
    - /url: http://127.0.0.1:8000/store/warung-kopi-bali-wayan
    - text: W
    - heading "Warung Kopi Bali Wayan" [level=3]
    - paragraph: Kuliner
    - paragraph: Warung kopi tradisional Bali dengan sentuhan modern, menyajikan kopi khas Kintamani dan makanan ringan lokal dengan cita rasa otentik.
  - link "K Kerajinan Perak Celuk Kerajinan Tangan Pengrajin perak asli Desa Celuk yang memproduksi aksesoris perak 925 buatan tangan dengan ukiran khas Bali yang detail dan elegan.":
    - /url: http://127.0.0.1:8000/store/kerajinan-perak-celuk
    - text: K
    - heading "Kerajinan Perak Celuk" [level=3]
    - paragraph: Kerajinan Tangan
    - paragraph: Pengrajin perak asli Desa Celuk yang memproduksi aksesoris perak 925 buatan tangan dengan ukiran khas Bali yang detail dan elegan.
  - link "Jelajahi Semua Toko":
    - /url: http://127.0.0.1:8000/store
    - text: Jelajahi Semua Toko
    - img
  - paragraph: Temukan Berdasarkan
  - heading "Kategori Produk" [level=2]
  - link "Aksesoris Aksesoris 4 Produk":
    - /url: http://127.0.0.1:8000/products?category=aksesoris
    - img "Aksesoris"
    - heading "Aksesoris" [level=3]
    - paragraph: 4 Produk
  - link "Minuman Minuman 3 Produk":
    - /url: http://127.0.0.1:8000/products?category=minuman
    - img "Minuman"
    - heading "Minuman" [level=3]
    - paragraph: 3 Produk
  - link "Makanan Makanan 2 Produk":
    - /url: http://127.0.0.1:8000/products?category=makanan
    - img "Makanan"
    - heading "Makanan" [level=3]
    - paragraph: 2 Produk
  - link "Pakaian Pakaian 0 Produk":
    - /url: http://127.0.0.1:8000/products?category=pakaian
    - img "Pakaian"
    - heading "Pakaian" [level=3]
    - paragraph: 0 Produk
  - link "Kesenian Kesenian 0 Produk":
    - /url: http://127.0.0.1:8000/products?category=kesenian
    - img "Kesenian"
    - heading "Kesenian" [level=3]
    - paragraph: 0 Produk
  - img "Pengrajin Bali bekerja"
  - img
  - blockquote: Saya belajar menenun sejak usia delapan tahun dari nenek saya. Setiap helai benang adalah doa dan harapan.
  - img "Ni Wayan Suartini"
  - paragraph: Ni Wayan Suartini
  - paragraph: Penenun Kain Endek — Klungkung, Bali
  - paragraph: Mengapa Kami
  - heading "Kenapa Smart UMKM Bali?" [level=2]
  - img
  - heading "100% Autentik" [level=3]
  - paragraph: Setiap produk dijamin autentik langsung dari tangan pengrajin UMKM Bali — tanpa perantara, tanpa imitasi.
  - img
  - heading "Langsung dari Pengrajin" [level=3]
  - paragraph: Harga yang Anda bayar langsung menjadi penghasilan pengrajin — mendukung ekonomi lokal dan keberlangsungan budaya.
  - img
  - heading "Transaksi Aman" [level=3]
  - paragraph: Pembayaran terenkripsi dan dilindungi oleh sistem keamanan berlapis. Belanja dengan tenang, tanpa rasa khawatir.
  - paragraph: Cerita Budaya
  - heading "Dari Hati Pulau Dewata" [level=2]
  - link "Semua Cerita":
    - /url: http://127.0.0.1:8000/blog
    - text: Semua Cerita
    - img
  - link "Budaya Filosofi Tridatu pada Kerajinan Perak Bali Tridatu terdiri dari tiga warna yaitu Merah, Putih, dan Hitam. Dalam pembuatan perhiasan perak di Desa Celuk, elemen tri...":
    - /url: http://127.0.0.1:8000/blog/filosofi-tridatu-kerajinan-perak-bali
    - paragraph: Budaya
    - heading "Filosofi Tridatu pada Kerajinan Perak Bali" [level=3]
    - paragraph: Tridatu terdiri dari tiga warna yaitu Merah, Putih, dan Hitam. Dalam pembuatan perhiasan perak di Desa Celuk, elemen tri...
  - link "Inovasi Transformasi Digital Kopi Kintamani Melalui platform Smart UMKM Bali, petani lokal...":
    - /url: http://127.0.0.1:8000/blog/transformasi-digital-kopi-kintamani
    - paragraph: Inovasi
    - heading "Transformasi Digital Kopi Kintamani" [level=3]
    - paragraph: Melalui platform Smart UMKM Bali, petani lokal...
  - paragraph: Kata Mereka
  - blockquote: "\"Kualitas ukiran kayunya luar biasa detail. Bisa merasakan langsung jiwa seni Bali di setiap goresannya. Sangat worth it!\""
  - paragraph: Sarah Anderson
  - paragraph: Melbourne, Australia
  - button "Testimonial 1"
  - button "Testimonial 2"
  - button "Testimonial 3"
  - text: "');\">"
  - paragraph: Untuk Pelaku UMKM
  - heading "Bawa Karya Anda ke Panggung Dunia" [level=2]:
    - text: Bawa Karya Anda ke
    - emphasis: Panggung Dunia
  - paragraph: Bergabunglah dengan ratusan pengrajin Bali lainnya. Kelola toko, jangkau pelanggan baru, dan ceritakan kisah di balik produk Anda.
  - link "Daftar Sebagai Merchant":
    - /url: http://127.0.0.1:8000/register
  - link "Sudah Punya Akun":
    - /url: http://127.0.0.1:8000/login
- contentinfo:
  - text: S Smart UMKM Bali
  - paragraph: Marketplace premium karya tangan Bali. Menghubungkan pengrajin lokal dengan dunia.
  - link "Instagram":
    - /url: "#"
    - img
  - link "Facebook":
    - /url: "#"
    - img
  - heading "Jelajahi" [level=3]
  - list:
    - listitem:
      - link "Semua Produk":
        - /url: http://127.0.0.1:8000/products
    - listitem:
      - link "Toko UMKM":
        - /url: http://127.0.0.1:8000/store
    - listitem:
      - link "Cerita Budaya":
        - /url: http://127.0.0.1:8000/blog
    - listitem:
      - link "Tentang Kami":
        - /url: http://127.0.0.1:8000/tentang-kami
  - heading "Bantuan" [level=3]
  - list:
    - listitem:
      - link "Masuk Merchant":
        - /url: http://127.0.0.1:8000/login
    - listitem:
      - link "Daftar Pembeli":
        - /url: http://127.0.0.1:8000/register
    - listitem:
      - link "Hubungi Kami":
        - /url: http://127.0.0.1:8000/kontak
  - heading "Newsletter" [level=3]
  - paragraph: Dapatkan info terbaru produk & cerita UMKM Bali.
  - textbox "Email Anda"
  - button "Kirim"
  - paragraph: © 2026 Smart UMKM Bali. Hak cipta dilindungi.
  - paragraph:
    - text: Dibuat dengan
    - img
    - text: untuk UMKM Bali
```

# Test source

```ts
  1  | import { test, expect } from '@playwright/test';
  2  | 
  3  | test.describe('Owner Flow', () => {
  4  | 
  5  |   test.beforeEach(async ({ page }) => {
  6  |     // Login as Owner
  7  |     await page.goto('/login');
  8  |     await page.fill('input[name="email"]', 'owner@smart-umkm.test');
  9  |     await page.fill('input[name="password"]', 'password');
  10 |     await page.click('button[type="submit"]');
  11 |     await expect(page).toHaveURL(/\/dashboard/);
  12 |   });
  13 | 
  14 |   test('View Dashboard', async ({ page }) => {
  15 |     await page.goto('/dashboard');
  16 |     await expect(page).toHaveTitle(/Dashboard/i);
  17 |     // Should see metrics
  18 |     await expect(page.locator('text=Total Penjualan').first()).toBeVisible();
  19 |   });
  20 | 
  21 |   test('View Inventory & Products', async ({ page }) => {
  22 |     await page.goto('/dashboard/products');
  23 |     await expect(page).toHaveTitle(/Produk/i);
  24 |     
  25 |     // Add product button should exist
  26 |     const addBtn = page.locator('a:has-text("Tambah Produk"), button:has-text("Tambah Produk")');
  27 |     await expect(addBtn).toBeVisible();
  28 |   });
  29 | 
  30 |   test('Create Product Validation', async ({ page }) => {
  31 |     await page.goto('/dashboard/products/create');
  32 |     
  33 |     // Try to submit empty form
  34 |     await page.click('button[type="submit"]');
  35 |     
  36 |     // Should stay on page due to HTML5 validation or show Laravel errors
> 37 |     await expect(page).toHaveURL(/\/dashboard\/products\/create/);
     |                        ^ Error: expect(page).toHaveURL(expected) failed
  38 |   });
  39 | 
  40 |   test('View Orders', async ({ page }) => {
  41 |     await page.goto('/dashboard/orders');
  42 |     await expect(page).toHaveTitle(/Pesanan/i);
  43 |   });
  44 | 
  45 |   test('View Staff/Cashiers', async ({ page }) => {
  46 |     await page.goto('/dashboard/staff');
  47 |     await expect(page).toHaveTitle(/Staf|Kasir/i);
  48 |   });
  49 | 
  50 |   test('Export Report PDF', async ({ page }) => {
  51 |     // Navigate to reports if it exists
  52 |     await page.goto('/dashboard/reports').catch(() => {});
  53 |     
  54 |     // Some apps use direct URL for export
  55 |     // Playwright can wait for download
  56 |     const exportBtn = page.locator('a[href*="export?format=pdf"]');
  57 |     if (await exportBtn.isVisible()) {
  58 |       const [download] = await Promise.all([
  59 |         page.waitForEvent('download'),
  60 |         exportBtn.click(),
  61 |       ]);
  62 |       expect(download.suggestedFilename()).toContain('.pdf');
  63 |     }
  64 |   });
  65 | 
  66 | });
  67 | 
```