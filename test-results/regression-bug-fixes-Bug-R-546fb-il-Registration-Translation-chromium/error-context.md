# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: regression/bug-fixes.spec.ts >> Bug Regression Tests >> Duplicate Email Registration Translation
- Location: tests/e2e/regression/bug-fixes.spec.ts:75:3

# Error details

```
Error: expect(locator).toBeVisible() failed

Locator: locator('text="telah digunakan"').or(locator('text="already been taken"')).first()
Expected: visible
Timeout: 5000ms
Error: element(s) not found

Call log:
  - Expect "toBeVisible" with timeout 5000ms
  - waiting for locator('text="telah digunakan"').or(locator('text="already been taken"')).first()

```

```yaml
- img
- heading "Smart UMKM Bali" [level=1]
- paragraph: Sistem manajemen usaha cerdas untuk pelaku UMKM di Bali. Kelola produk, catat transaksi, dan pantau performa bisnis Anda.
- text: 500+ UMKM Aktif 10K+ Transaksi/Hari 99.9% Uptime
- heading "Daftar Akun" [level=2]
- paragraph: Buat akun untuk mulai menjelajahi produk UMKM lokal
- text: Nama Lengkap
- textbox "Nama Lengkap":
  - /placeholder: Nama lengkap Anda
  - text: Cloner
- text: Mendaftar sebagai
- radio "Pelanggan" [checked]
- text: Pelanggan
- radio "Pemilik Usaha (UMKM)"
- text: Pemilik Usaha (UMKM) Email
- textbox "Email":
  - /placeholder: contoh@email.com
  - text: owner@smart-umkm.test
- list:
  - listitem: Email telah digunakan.
- text: Keamanan Password
- textbox "Password":
  - /placeholder: Minimal 8 karakter
- text: Konfirmasi Password
- textbox "Konfirmasi Password":
  - /placeholder: Ulangi password
- button "Daftar Sekarang"
- paragraph:
  - text: Sudah punya akun?
  - link "Masuk":
    - /url: http://127.0.0.1:8000/login
- paragraph: © 2026 Smart UMKM Bali
```

# Test source

```ts
  1  | import { test, expect } from '@playwright/test';
  2  | 
  3  | test.describe('Bug Regression Tests', () => {
  4  | 
  5  |   // Bug 1: Cross Tenant Access
  6  |   test('Cross Tenant Order Access is Blocked', async ({ request }) => {
  7  |     // Attempt to access a random non-existent or other user's order
  8  |     const orderReq = await request.get('/customer/orders/999999', { maxRedirects: 0 });
  9  |     // Since we're unauthenticated here, it should redirect to login (302) or 403
  10 |     expect([302, 403, 404]).toContain(orderReq.status());
  11 |   });
  12 | 
  13 |   // Bug 2: Stock Validation 
  14 |   test('Add to Cart Exceeds Stock Shows Error', async ({ page }) => {
  15 |     await page.goto('/store');
  16 |     const firstProductLink = page.locator('.product-card a').first();
  17 |     if (await firstProductLink.isVisible()) {
  18 |       await firstProductLink.click();
  19 |       
  20 |       const qtyInput = page.locator('input[name="quantity"]:not([type="hidden"])');
  21 |       if (await qtyInput.isVisible()) {
  22 |         await qtyInput.fill('99999');
  23 |         await page.click('button:has-text("Tambah ke Keranjang")');
  24 |         
  25 |         // Wait for potential toast or just verify we don't go to checkout
  26 |         await expect(page).toHaveURL(/products|store/);
  27 |       }
  28 |     }
  29 |   });
  30 | 
  31 |   // Bug 3: Redirect Logic
  32 |   test('Admin Login Redirects to Admin Dashboard', async ({ page }) => {
  33 |     await page.goto('/login');
  34 |     await page.fill('input[name="email"]', 'admin@smart-umkm.test');
  35 |     await page.fill('input[name="password"]', 'password');
  36 |     await page.click('button[type="submit"]');
  37 | 
  38 |     await expect(page).toHaveURL(/\/admin\/dashboard/);
  39 |   });
  40 | 
  41 |   // Bug 4: Store Registration Flow
  42 |   test('Owner Registration Redirects to Create Store', async ({ page }) => {
  43 |     await page.goto('/register');
  44 |     
  45 |     // Choose Owner Role
  46 |     await page.locator('input[value="owner"]').check();
  47 | 
  48 |     const uniqueEmail = `owner_regression_${Date.now()}@smart-umkm.test`;
  49 |     await page.fill('input[name="name"]', 'Owner Regression');
  50 |     await page.fill('input[name="email"]', uniqueEmail);
  51 |     await page.fill('input[name="password"]', 'password123');
  52 |     await page.fill('input[name="password_confirmation"]', 'password123');
  53 |     await page.click('button[type="submit"]');
  54 | 
  55 |     await expect(page).toHaveURL(/\/stores\/create/);
  56 |   });
  57 | 
  58 |   // Bug 5: Product Validation Message
  59 |   test('Create Product Shows Error when Missing Price', async ({ page }) => {
  60 |     await page.goto('/login');
  61 |     await page.fill('input[name="email"]', 'owner@smart-umkm.test');
  62 |     await page.fill('input[name="password"]', 'password');
  63 |     await page.click('button[type="submit"]');
  64 | 
  65 |     await page.goto('/dashboard/products/create');
  66 |     
  67 |     await page.fill('input[name="name"]', 'Invalid Product');
  68 |     // Skip prices
  69 |     await page.click('button:has-text("Simpan Produk")');
  70 | 
  71 |     await expect(page).toHaveURL(/\/dashboard\/products\/create/);
  72 |   });
  73 | 
  74 |   // Bug 6: Duplicate Email Error Translation
  75 |   test('Duplicate Email Registration Translation', async ({ page }) => {
  76 |     await page.goto('/register');
  77 |     // Try to register an existing email
  78 |     await page.fill('input[name="name"]', 'Cloner');
  79 |     await page.fill('input[name="email"]', 'owner@smart-umkm.test');
  80 |     await page.fill('input[name="password"]', 'password123');
  81 |     await page.fill('input[name="password_confirmation"]', 'password123');
  82 |     await page.click('button[type="submit"]');
  83 | 
  84 |     const errorMsg = page.locator('text="telah digunakan"').or(page.locator('text="already been taken"')).first();
> 85 |     await expect(errorMsg).toBeVisible();
     |                            ^ Error: expect(locator).toBeVisible() failed
  86 |   });
  87 | 
  88 | });
  89 | 
```