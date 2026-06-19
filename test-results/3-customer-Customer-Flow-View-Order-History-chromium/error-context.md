# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: 3-customer.spec.ts >> Customer Flow >> View Order History
- Location: tests/e2e/3-customer.spec.ts:46:3

# Error details

```
Error: expect(page).toHaveTitle(expected) failed

Expected pattern: /Pesanan Saya/i
Received string:  "Smart UMKM Bali — Akun Saya"
Timeout: 5000ms

Call log:
  - Expect "toHaveTitle" with timeout 5000ms
    14 × unexpected value "Smart UMKM Bali — Akun Saya"

```

```yaml
- complementary:
  - link "S Smart UMKM Bali":
    - /url: http://127.0.0.1:8000
  - navigation:
    - link "Dashboard":
      - /url: http://127.0.0.1:8000/customer/dashboard
      - img
      - text: Dashboard
    - link "Pesanan Saya":
      - /url: http://127.0.0.1:8000/customer/orders
      - img
      - text: Pesanan Saya
    - paragraph: Pengaturan
    - link "Profil Saya":
      - /url: http://127.0.0.1:8000/customer/profile
      - img
      - text: Profil Saya
    - link "Alamat Pengiriman":
      - /url: http://127.0.0.1:8000/customer/address
      - img
      - text: Alamat Pengiriman
  - text: "N"
  - paragraph: Ni Luh Putu
  - paragraph: Pembeli
  - button "Logout":
    - img
- heading "Riwayat Pesanan" [level=2]
- main:
  - text: INV-20260619-9999 19 Jun 2026, 15:48 Menunggu Pembayaran
  - img
  - text: Kerajinan Perak Celuk
  - paragraph: Cincin Perak Ukir Tridatu
  - paragraph: 1 x Rp 350.000
  - paragraph: Total Belanja
  - paragraph: Rp 375.000
  - link "Lihat Detail":
    - /url: http://127.0.0.1:8000/customer/orders/68
```

# Test source

```ts
  1  | import { test, expect } from '@playwright/test';
  2  | 
  3  | test.describe('Customer Flow', () => {
  4  | 
  5  |   test.beforeEach(async ({ page }) => {
  6  |     // Login as Customer before each test
  7  |     await page.goto('/login');
  8  |     await page.fill('input[name="email"]', 'customer@smart-umkm.test');
  9  |     await page.fill('input[name="password"]', 'password');
  10 |     await page.click('button[type="submit"]');
  11 |     await expect(page).toHaveURL(/\/customer\/dashboard|\/dashboard|\//);
  12 |   });
  13 | 
  14 |   test('View Dashboard', async ({ page }) => {
  15 |     await page.goto('/customer/dashboard');
  16 |     await expect(page).toHaveTitle(/Dashboard/i);
  17 |     // Should see addresses or profile section
  18 |     await expect(page.locator('text=Alamat Pengiriman').first()).toBeVisible();
  19 |   });
  20 | 
  21 |   test('Add Address', async ({ page }) => {
  22 |     await page.goto('/customer/dashboard');
  23 |     
  24 |     // Check if Add Address button or form exists
  25 |     const addBtn = page.locator('button:has-text("Tambah Alamat"), a:has-text("Tambah Alamat")');
  26 |     if (await addBtn.isVisible()) {
  27 |       await addBtn.click();
  28 |       await page.fill('input[name="recipient_name"]', 'Budi Test');
  29 |       await page.fill('input[name="phone"]', '08123456789');
  30 |       // If province/city are selects or text inputs
  31 |       await page.fill('input[name="province"]', 'Bali').catch(() => {});
  32 |       await page.fill('input[name="city"]', 'Denpasar').catch(() => {});
  33 |       await page.fill('textarea[name="address"]', 'Jalan Pantai Kuta');
  34 |       await page.click('button[type="submit"]');
  35 |       
  36 |       // Should return to dashboard or show success message
  37 |       await expect(page).toHaveURL(/\/customer\/dashboard/);
  38 |     }
  39 |   });
  40 | 
  41 |   test('View Cart', async ({ page }) => {
  42 |     await page.goto('/cart');
  43 |     await expect(page).toHaveTitle(/Keranjang/i);
  44 |   });
  45 | 
  46 |   test('View Order History', async ({ page }) => {
  47 |     await page.goto('/customer/orders');
> 48 |     await expect(page).toHaveTitle(/Pesanan Saya/i);
     |                        ^ Error: expect(page).toHaveTitle(expected) failed
  49 |   });
  50 | 
  51 | });
  52 | 
```