# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: 4-owner.spec.ts >> Owner Flow >> View Staff/Cashiers
- Location: tests/e2e/4-owner.spec.ts:45:3

# Error details

```
Error: expect(page).toHaveTitle(expected) failed

Expected pattern: /Staf|Kasir/i
Received string:  "Halaman Tidak Ditemukan - Smart UMKM Bali"
Timeout: 5000ms

Call log:
  - Expect "toHaveTitle" with timeout 5000ms
    14 × unexpected value "Halaman Tidak Ditemukan - Smart UMKM Bali"

```

```yaml
- img
- text: "404"
- heading "Halaman Tidak Ditemukan" [level=1]
- paragraph: Maaf, halaman atau produk yang Anda cari mungkin telah dipindahkan, dihapus, atau tidak pernah ada.
- link "Kembali ke Beranda":
  - /url: http://127.0.0.1:8000
  - img
  - text: Kembali ke Beranda
- button "Kembali Sebelumnya":
  - img
  - text: Kembali Sebelumnya
- text: © 2026 Smart UMKM Bali
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
  37 |     await expect(page).toHaveURL(/\/dashboard\/products\/create/);
  38 |   });
  39 | 
  40 |   test('View Orders', async ({ page }) => {
  41 |     await page.goto('/dashboard/orders');
  42 |     await expect(page).toHaveTitle(/Pesanan/i);
  43 |   });
  44 | 
  45 |   test('View Staff/Cashiers', async ({ page }) => {
  46 |     await page.goto('/dashboard/staff');
> 47 |     await expect(page).toHaveTitle(/Staf|Kasir/i);
     |                        ^ Error: expect(page).toHaveTitle(expected) failed
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