# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: critical/3-validation.spec.ts >> Validation Flow >> Create Product Missing Price
- Location: tests/e2e/critical/3-validation.spec.ts:83:3

# Error details

```
Error: expect(page).toHaveURL(expected) failed

Expected pattern: /\/dashboard\/products\/create/
Received string:  "http://127.0.0.1:8000/"
Timeout: 5000ms

Call log:
  - Expect "toHaveURL" with timeout 5000ms
    14 × unexpected value "http://127.0.0.1:8000/"

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
  1   | import { test, expect } from '@playwright/test';
  2   | 
  3   | test.describe('Validation Flow', () => {
  4   | 
  5   |   // 17. Checkout Without Address
  6   |   test('Checkout Without Address', async ({ page }) => {
  7   |     // This assumes user has no address, or we forcefully submit without selecting address
  8   |     // Since UI might prevent clicking "Selesaikan Pesanan", we check if the button is disabled
  9   |     // or if error message appears
  10  |     await page.goto('/login');
  11  |     await page.fill('input[name="email"]', 'customer@smart-umkm.test');
  12  |     await page.fill('input[name="password"]', 'password');
  13  |     await page.click('button[type="submit"]');
  14  | 
  15  |     await page.goto('/checkout');
  16  |     // Uncheck all addresses if possible, or submit directly
  17  |     const submitBtn = page.locator('button:has-text("Selesaikan Pesanan")');
  18  |     if (await submitBtn.isVisible()) {
  19  |       await submitBtn.click();
  20  |       // Should show validation error or not navigate away
  21  |       await expect(page).toHaveURL(/\/checkout/);
  22  |     }
  23  |   });
  24  | 
  25  |   // 18. Add to Cart Exceeds Stock
  26  |   test('Add to Cart Exceeds Stock', async ({ page }) => {
  27  |     await page.goto('/login');
  28  |     await page.fill('input[name="email"]', 'customer@smart-umkm.test');
  29  |     await page.fill('input[name="password"]', 'password');
  30  |     await page.click('button[type="submit"]');
  31  | 
  32  |     await page.goto('/products');
  33  |     const firstProductLink = page.locator('a.product-card-link, a[href*="/products/"]').first();
  34  |     if (await firstProductLink.isVisible()) {
  35  |       await firstProductLink.click();
  36  |       
  37  |       const qtyInput = page.locator('input[name="quantity"]:not([type="hidden"])');
  38  |       if (await qtyInput.isVisible()) {
  39  |         await qtyInput.fill('99999'); // Exceeding realistic stock
  40  |         await page.click('button:has-text("Tambah ke Keranjang")');
  41  |         // Expect validation error alert or toast
  42  |         const errorMessage = page.locator('.alert-danger, .toast-error, text="Maksimal"');
  43  |         // Just verify we don't crash
  44  |         await expect(page).toHaveURL(/products\//);
  45  |       }
  46  |     }
  47  |   });
  48  | 
  49  |   // 19. POS Underpayment
  50  |   test('POS Underpayment', async ({ page }) => {
  51  |     await page.goto('/login');
  52  |     await page.fill('input[name="email"]', 'cashier@smart-umkm.test');
  53  |     await page.fill('input[name="password"]', 'password');
  54  |     await page.click('button[type="submit"]');
  55  | 
  56  |     await page.goto('/dashboard/transactions/create').catch(() => page.goto('/cashier/pos'));
  57  |     const firstProduct = page.locator('button.add-to-cart-pos').first();
  58  |     if (await firstProduct.isVisible()) {
  59  |       await firstProduct.click();
  60  |       
  61  |       const payBtn = page.locator('button:has-text("Bayar")');
  62  |       if (await payBtn.isVisible()) {
  63  |         await payBtn.click();
  64  |         
  65  |         const amountInput = page.locator('input[name="payment_amount"], input[name="cash_received"]');
  66  |         if (await amountInput.isVisible()) {
  67  |           await amountInput.fill('100'); // Unlikely to be enough for anything
  68  |           
  69  |           const processBtn = page.locator('button:has-text("Proses Pembayaran"), button:has-text("Selesaikan")');
  70  |           
  71  |           // Button might be disabled, or clicking it shows an error
  72  |           if (await processBtn.isEnabled()) {
  73  |             await processBtn.click();
  74  |             // Should not navigate to success/receipt
  75  |             await expect(page.locator('.receipt')).toBeHidden();
  76  |           }
  77  |         }
  78  |       }
  79  |     }
  80  |   });
  81  | 
  82  |   // 20. Create Product Missing Price
  83  |   test('Create Product Missing Price', async ({ page }) => {
  84  |     await page.goto('/login');
  85  |     await page.fill('input[name="email"]', 'owner@smart-umkm.test');
  86  |     await page.fill('input[name="password"]', 'password');
  87  |     await page.click('button[type="submit"]');
  88  | 
  89  |     await page.goto('/dashboard/products/create');
  90  |     await page.fill('input[name="name"]', 'Produk Tanpa Harga');
  91  |     // Deliberately skipping cost_price and sell_price
  92  |     await page.click('button[type="submit"]');
  93  |     
  94  |     // Expect to remain on the create page due to validation
> 95  |     await expect(page).toHaveURL(/\/dashboard\/products\/create/);
      |                        ^ Error: expect(page).toHaveURL(expected) failed
  96  |   });
  97  | 
  98  |   // 21. Store Suspend Missing Reason
  99  |   test('Store Suspend Missing Reason', async ({ page }) => {
  100 |     await page.goto('/login');
  101 |     await page.fill('input[name="email"]', 'admin@smart-umkm.test');
  102 |     await page.fill('input[name="password"]', 'password');
  103 |     await page.click('button[type="submit"]');
  104 | 
  105 |     await page.goto('/admin/stores');
  106 |     const suspendBtn = page.locator('button:has-text("Suspend"), button:has-text("Tangguhkan")').first();
  107 |     if (await suspendBtn.isVisible()) {
  108 |       await suspendBtn.click();
  109 |       const confirmBtn = page.locator('button:has-text("Konfirmasi"), button:has-text("Yakin")');
  110 |       
  111 |       // Leaving reason empty
  112 |       await confirmBtn.click();
  113 |       
  114 |       // Should remain open or show error
  115 |       const modal = page.locator('div[role="dialog"]');
  116 |       await expect(modal).toBeVisible();
  117 |     }
  118 |   });
  119 | 
  120 |   // 22. Duplicate Email Registration
  121 |   test('Duplicate Email Registration', async ({ page }) => {
  122 |     await page.goto('/register');
  123 |     await page.fill('input[name="name"]', 'Customer Duplicate');
  124 |     await page.fill('input[name="email"]', 'customer@smart-umkm.test'); // Already exists
  125 |     await page.fill('input[name="password"]', 'password123');
  126 |     await page.fill('input[name="password_confirmation"]', 'password123');
  127 |     await page.click('button[type="submit"]');
  128 |     
  129 |     // Expect validation error
  130 |     const errorMsg = page.locator('text="telah digunakan"').or(page.locator('text="already been taken"')).first();
  131 |     await expect(errorMsg).toBeVisible();
  132 |   });
  133 | 
  134 | });
  135 | 
```