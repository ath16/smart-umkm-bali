# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: 2-guest.spec.ts >> Guest Flow >> View Products Catalog
- Location: tests/e2e/2-guest.spec.ts:16:3

# Error details

```
Error: expect(locator).toBeVisible() failed

Locator: locator('input[name="q"], input[type="search"]')
Expected: visible
Timeout: 5000ms
Error: element(s) not found

Call log:
  - Expect "toBeVisible" with timeout 5000ms
  - waiting for locator('input[name="q"], input[type="search"]')

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
  - paragraph: Koleksi
  - heading "Katalog Produk" [level=1]
  - paragraph: 9 produk ditemukan
  - link "Semua":
    - /url: http://127.0.0.1:8000/products
  - link "Makanan":
    - /url: http://127.0.0.1:8000/products?category=makanan
  - link "Minuman":
    - /url: http://127.0.0.1:8000/products?category=minuman
  - link "Pakaian":
    - /url: http://127.0.0.1:8000/products?category=pakaian
  - link "Aksesoris":
    - /url: http://127.0.0.1:8000/products?category=aksesoris
  - link "Kesenian":
    - /url: http://127.0.0.1:8000/products?category=kesenian
  - combobox:
    - option "Terbaru" [selected]
    - option "Harga ↑"
    - option "Harga ↓"
  - button "Filter":
    - img
    - text: Filter
  - link "Minuman Kopi Bali Kintamani 250g Warung Kopi Bali Wayan Rp65.000":
    - /url: http://127.0.0.1:8000/products/kopi-bali-kintamani-250g
    - img
    - paragraph: Minuman
    - heading "Kopi Bali Kintamani 250g" [level=3]
    - paragraph: Warung Kopi Bali Wayan
    - paragraph: Rp65.000
  - link "Minuman Es Kopi Susu Gula Aren Warung Kopi Bali Wayan Rp22.000":
    - /url: http://127.0.0.1:8000/products/es-kopi-susu-gula-aren
    - img
    - paragraph: Minuman
    - heading "Es Kopi Susu Gula Aren" [level=3]
    - paragraph: Warung Kopi Bali Wayan
    - paragraph: Rp22.000
  - link "Makanan Pie Susu Bali Premium (1 Kotak) Warung Kopi Bali Wayan Rp35.000":
    - /url: http://127.0.0.1:8000/products/pie-susu-bali-premium-1-kotak
    - img
    - paragraph: Makanan
    - heading "Pie Susu Bali Premium (1 Kotak)" [level=3]
    - paragraph: Warung Kopi Bali Wayan
    - paragraph: Rp35.000
  - link "Minuman Kopi Arabica Plaga 200g Warung Kopi Bali Wayan Rp85.000":
    - /url: http://127.0.0.1:8000/products/kopi-arabica-plaga-200g
    - img
    - paragraph: Minuman
    - heading "Kopi Arabica Plaga 200g" [level=3]
    - paragraph: Warung Kopi Bali Wayan
    - paragraph: Rp85.000
  - link "Makanan Kacang Kapri Tari Bali Warung Kopi Bali Wayan Rp25.000":
    - /url: http://127.0.0.1:8000/products/kacang-kapri-tari-bali
    - img
    - paragraph: Makanan
    - heading "Kacang Kapri Tari Bali" [level=3]
    - paragraph: Warung Kopi Bali Wayan
    - paragraph: Rp25.000
  - link "Aksesoris Cincin Perak Ukir Tridatu Kerajinan Perak Celuk Rp350.000":
    - /url: http://127.0.0.1:8000/products/cincin-perak-ukir-tridatu
    - img
    - paragraph: Aksesoris
    - heading "Cincin Perak Ukir Tridatu" [level=3]
    - paragraph: Kerajinan Perak Celuk
    - paragraph: Rp350.000
  - link "Aksesoris Kalung Mutiara Air Tawar Kerajinan Perak Celuk Rp600.000":
    - /url: http://127.0.0.1:8000/products/kalung-mutiara-air-tawar
    - img
    - paragraph: Aksesoris
    - heading "Kalung Mutiara Air Tawar" [level=3]
    - paragraph: Kerajinan Perak Celuk
    - paragraph: Rp600.000
  - link "Aksesoris Gelang Perak Anyam Kerajinan Perak Celuk Rp280.000":
    - /url: http://127.0.0.1:8000/products/gelang-perak-anyam
    - img
    - paragraph: Aksesoris
    - heading "Gelang Perak Anyam" [level=3]
    - paragraph: Kerajinan Perak Celuk
    - paragraph: Rp280.000
  - link "Aksesoris Bros Kebaya Perak Kerajinan Perak Celuk Rp450.000":
    - /url: http://127.0.0.1:8000/products/bros-kebaya-perak
    - img
    - paragraph: Aksesoris
    - heading "Bros Kebaya Perak" [level=3]
    - paragraph: Kerajinan Perak Celuk
    - paragraph: Rp450.000
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
  3  | test.describe('Guest Flow', () => {
  4  | 
  5  |   test('View Landing Page', async ({ page }) => {
  6  |     await page.goto('/');
  7  |     
  8  |     // Title should contain Smart UMKM Bali
  9  |     await expect(page).toHaveTitle(/Smart UMKM Bali/);
  10 | 
  11 |     // Should see Hero section or Explore Products
  12 |     const heading = page.locator('h1').first();
  13 |     await expect(heading).toBeVisible();
  14 |   });
  15 | 
  16 |   test('View Products Catalog', async ({ page }) => {
  17 |     await page.goto('/products');
  18 |     
  19 |     // Verify there is a search input
  20 |     const searchInput = page.locator('input[name="q"], input[type="search"]');
> 21 |     await expect(searchInput).toBeVisible();
     |                               ^ Error: expect(locator).toBeVisible() failed
  22 | 
  23 |     // Verify there are product cards (assuming there's a grid of products)
  24 |     // We don't rely on exact count in case db is empty, but if seeded, there should be items
  25 |     // Just verifying the page loads without 500 error
  26 |     await expect(page).toHaveURL(/\/products/);
  27 |   });
  28 | 
  29 |   test('Product Search', async ({ page }) => {
  30 |     await page.goto('/products');
  31 |     
  32 |     const searchInput = page.locator('input[name="q"]');
  33 |     if (await searchInput.isVisible()) {
  34 |       await searchInput.fill('Kopi');
  35 |       await searchInput.press('Enter');
  36 |       
  37 |       // The URL should contain q=Kopi
  38 |       await expect(page).toHaveURL(/q=Kopi/i);
  39 |     }
  40 |   });
  41 | 
  42 |   test('View Store List', async ({ page }) => {
  43 |     await page.goto('/stores');
  44 |     await expect(page).toHaveURL(/\/stores/);
  45 |   });
  46 | 
  47 | });
  48 | 
```