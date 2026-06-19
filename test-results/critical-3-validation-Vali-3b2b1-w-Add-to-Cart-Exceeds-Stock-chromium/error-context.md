# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: critical/3-validation.spec.ts >> Validation Flow >> Add to Cart Exceeds Stock
- Location: tests/e2e/critical/3-validation.spec.ts:26:3

# Error details

```
Test timeout of 30000ms exceeded.
```

```
Error: page.click: Test timeout of 30000ms exceeded.
Call log:
  - waiting for locator('button:has-text("Tambah ke Keranjang")')

```

# Page snapshot

```yaml
- generic [ref=e1]:
  - navigation [ref=e2]:
    - generic [ref=e4]:
      - generic [ref=e5]:
        - link "S Smart UMKM Bali" [ref=e7] [cursor=pointer]:
          - /url: http://127.0.0.1:8000
          - generic [ref=e9]: S
          - generic [ref=e10]: Smart UMKM Bali
        - generic [ref=e11]:
          - link "Beranda" [ref=e12] [cursor=pointer]:
            - /url: http://127.0.0.1:8000
          - link "Toko" [ref=e13] [cursor=pointer]:
            - /url: http://127.0.0.1:8000/store
          - link "Produk" [ref=e14] [cursor=pointer]:
            - /url: http://127.0.0.1:8000/products
            - text: Produk
          - link "Cerita" [ref=e16] [cursor=pointer]:
            - /url: http://127.0.0.1:8000/blog
          - link "Tentang" [ref=e17] [cursor=pointer]:
            - /url: http://127.0.0.1:8000/tentang-kami
      - generic [ref=e20]:
        - generic:
          - img
        - textbox "Cari produk..." [ref=e21]
      - generic [ref=e22]:
        - link [ref=e23] [cursor=pointer]:
          - /url: http://127.0.0.1:8000/cart
          - img [ref=e24]
        - link "Dasbor" [ref=e26] [cursor=pointer]:
          - /url: http://127.0.0.1:8000/dashboard
  - main [ref=e28]:
    - generic [ref=e29]:
      - navigation "Breadcrumb" [ref=e31]:
        - list [ref=e32]:
          - listitem [ref=e33]:
            - link "Beranda" [ref=e34] [cursor=pointer]:
              - /url: http://127.0.0.1:8000
          - listitem [ref=e35]: /
          - listitem [ref=e36]:
            - link "Produk" [ref=e37] [cursor=pointer]:
              - /url: http://127.0.0.1:8000/products
          - listitem [ref=e38]: /
          - listitem [ref=e39]:
            - link "Minuman" [ref=e40] [cursor=pointer]:
              - /url: http://127.0.0.1:8000/products?category=minuman
          - listitem [ref=e41]: /
          - listitem [ref=e42]: Kopi Bali Kintamani 250g
      - generic [ref=e44]:
        - img [ref=e48]
        - generic [ref=e51]:
          - paragraph [ref=e52]: Minuman
          - heading "Kopi Bali Kintamani 250g" [level=1] [ref=e53]
          - generic [ref=e54]:
            - generic [ref=e55]: Rp65.000
            - generic [ref=e56]: Stok tersedia
          - generic [ref=e58]:
            - generic [ref=e59]:
              - generic [ref=e60]: Jumlah
              - generic [ref=e61]:
                - button [ref=e62] [cursor=pointer]:
                  - img [ref=e63]
                - spinbutton [active] [ref=e64]: "99999"
                - button [ref=e65] [cursor=pointer]:
                  - img [ref=e66]
            - button "Tambahkan ke Keranjang" [ref=e68] [cursor=pointer]
          - generic [ref=e69]:
            - generic [ref=e70]:
              - button "Deskripsi" [ref=e71] [cursor=pointer]:
                - generic [ref=e72]: Deskripsi
                - img [ref=e73]
              - paragraph [ref=e76]: Produk asli buatan Bali dengan kualitas premium.
            - button "Pengiriman" [ref=e78] [cursor=pointer]:
              - generic [ref=e79]: Pengiriman
              - img [ref=e80]
            - button "Perawatan Produk" [ref=e83] [cursor=pointer]:
              - generic [ref=e84]: Perawatan Produk
              - img [ref=e85]
          - generic [ref=e87]:
            - generic [ref=e88]:
              - generic [ref=e90]: W
              - generic [ref=e91]:
                - paragraph [ref=e92]: Dibuat oleh
                - paragraph [ref=e93]: Warung Kopi Bali Wayan
            - paragraph [ref=e94]: Warung kopi tradisional Bali dengan sentuhan modern, menyajikan kopi khas Kintamani dan makanan ringan lokal dengan cita rasa otentik.
            - link "Kunjungi Toko" [ref=e95] [cursor=pointer]:
              - /url: http://127.0.0.1:8000/store/warung-kopi-bali-wayan
              - text: Kunjungi Toko
              - img [ref=e96]
      - generic [ref=e99]:
        - heading "Ulasan Pelanggan" [level=2] [ref=e100]
        - paragraph [ref=e102]: Belum ada ulasan. Jadilah yang pertama memberikan ulasan!
      - generic [ref=e104]:
        - generic [ref=e105]:
          - heading "Produk Serupa" [level=2] [ref=e106]
          - link "Lihat Semua" [ref=e107] [cursor=pointer]:
            - /url: http://127.0.0.1:8000/products?category=minuman
            - text: Lihat Semua
            - img [ref=e108]
        - generic [ref=e110]:
          - link "Minuman Es Kopi Susu Gula Aren Rp22.000" [ref=e111] [cursor=pointer]:
            - /url: http://127.0.0.1:8000/products/es-kopi-susu-gula-aren
            - img [ref=e114]
            - paragraph [ref=e116]: Minuman
            - heading "Es Kopi Susu Gula Aren" [level=3] [ref=e117]
            - paragraph [ref=e118]: Rp22.000
          - link "Minuman Kopi Arabica Plaga 200g Rp85.000" [ref=e119] [cursor=pointer]:
            - /url: http://127.0.0.1:8000/products/kopi-arabica-plaga-200g
            - img [ref=e122]
            - paragraph [ref=e124]: Minuman
            - heading "Kopi Arabica Plaga 200g" [level=3] [ref=e125]
            - paragraph [ref=e126]: Rp85.000
  - contentinfo [ref=e127]:
    - generic [ref=e129]:
      - generic [ref=e130]:
        - generic [ref=e131]:
          - generic [ref=e132]:
            - generic [ref=e134]: S
            - generic [ref=e135]: Smart UMKM Bali
          - paragraph [ref=e136]: Marketplace premium karya tangan Bali. Menghubungkan pengrajin lokal dengan dunia.
          - generic [ref=e137]:
            - link "Instagram" [ref=e138] [cursor=pointer]:
              - /url: "#"
              - img [ref=e139]
            - link "Facebook" [ref=e141] [cursor=pointer]:
              - /url: "#"
              - img [ref=e142]
        - generic [ref=e144]:
          - heading "Jelajahi" [level=3] [ref=e145]
          - list [ref=e146]:
            - listitem [ref=e147]:
              - link "Semua Produk" [ref=e148] [cursor=pointer]:
                - /url: http://127.0.0.1:8000/products
            - listitem [ref=e149]:
              - link "Toko UMKM" [ref=e150] [cursor=pointer]:
                - /url: http://127.0.0.1:8000/store
            - listitem [ref=e151]:
              - link "Cerita Budaya" [ref=e152] [cursor=pointer]:
                - /url: http://127.0.0.1:8000/blog
            - listitem [ref=e153]:
              - link "Tentang Kami" [ref=e154] [cursor=pointer]:
                - /url: http://127.0.0.1:8000/tentang-kami
        - generic [ref=e155]:
          - heading "Bantuan" [level=3] [ref=e156]
          - list [ref=e157]:
            - listitem [ref=e158]:
              - link "Masuk Merchant" [ref=e159] [cursor=pointer]:
                - /url: http://127.0.0.1:8000/login
            - listitem [ref=e160]:
              - link "Daftar Pembeli" [ref=e161] [cursor=pointer]:
                - /url: http://127.0.0.1:8000/register
            - listitem [ref=e162]:
              - link "Hubungi Kami" [ref=e163] [cursor=pointer]:
                - /url: http://127.0.0.1:8000/kontak
        - generic [ref=e164]:
          - heading "Newsletter" [level=3] [ref=e165]
          - paragraph [ref=e166]: Dapatkan info terbaru produk & cerita UMKM Bali.
          - generic [ref=e167]:
            - textbox "Email Anda" [ref=e168]
            - button "Kirim" [ref=e169] [cursor=pointer]
      - generic [ref=e170]:
        - paragraph [ref=e171]: © 2026 Smart UMKM Bali. Hak cipta dilindungi.
        - paragraph [ref=e172]:
          - text: Dibuat dengan
          - img [ref=e173]
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
> 40  |         await page.click('button:has-text("Tambah ke Keranjang")');
      |                    ^ Error: page.click: Test timeout of 30000ms exceeded.
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
  95  |     await expect(page).toHaveURL(/\/dashboard\/products\/create/);
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