# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: 1-auth.spec.ts >> Authentication Flow >> Customer Registration
- Location: tests/e2e/1-auth.spec.ts:5:3

# Error details

```
Error: expect(page).toHaveTitle(expected) failed

Expected pattern: /Daftar | Smart UMKM Bali/i
Received string:  "Smart UMKM Bali"
Timeout: 5000ms

Call log:
  - Expect "toHaveTitle" with timeout 5000ms
    14 × unexpected value "Smart UMKM Bali"

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
- text: Mendaftar sebagai
- radio "Pelanggan" [checked]
- text: Pelanggan
- radio "Pemilik Usaha (UMKM)"
- text: Pemilik Usaha (UMKM) Email
- textbox "Email":
  - /placeholder: contoh@email.com
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
  3  | test.describe('Authentication Flow', () => {
  4  |   
  5  |   test('Customer Registration', async ({ page }) => {
  6  |     // Generate random email to avoid duplicate
  7  |     const uniqueEmail = `test_customer_${Date.now()}@example.com`;
  8  | 
  9  |     await page.goto('/register');
> 10 |     await expect(page).toHaveTitle(/Daftar | Smart UMKM Bali/i);
     |                        ^ Error: expect(page).toHaveTitle(expected) failed
  11 | 
  12 |     // Fill the registration form
  13 |     await page.fill('input[name="name"]', 'Budi Playwright');
  14 |     await page.fill('input[name="email"]', uniqueEmail);
  15 |     await page.fill('input[name="password"]', 'password123');
  16 |     await page.fill('input[name="password_confirmation"]', 'password123');
  17 |     
  18 |     // Select role if there is a role selector, default is customer
  19 |     // Check if role selector exists, if yes, select customer
  20 |     const roleSelect = page.locator('select[name="role"]');
  21 |     if (await roleSelect.isVisible()) {
  22 |       await roleSelect.selectOption('customer');
  23 |     }
  24 | 
  25 |     await page.click('button[type="submit"]');
  26 | 
  27 |     // Should redirect to dashboard
  28 |     await expect(page).toHaveURL(/\/customer\/dashboard|\/dashboard/);
  29 |     
  30 |     // Check that we are logged in (e.g. Profile button or Logout button is visible)
  31 |     // Wait for the navigation bar
  32 |     const nav = page.locator('nav');
  33 |     await expect(nav).toBeVisible();
  34 |     
  35 |     // Logout
  36 |     await page.goto('/customer/dashboard'); // ensure we are on a page with logout
  37 |     await page.evaluate(() => {
  38 |         // Trigger a fake POST request to logout if the button is hidden in a dropdown
  39 |         const form = document.createElement('form');
  40 |         form.method = 'POST';
  41 |         form.action = '/logout';
  42 |         const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
  43 |         if (csrfToken) {
  44 |             const input = document.createElement('input');
  45 |             input.type = 'hidden';
  46 |             input.name = '_token';
  47 |             input.value = csrfToken;
  48 |             form.appendChild(input);
  49 |         }
  50 |         document.body.appendChild(form);
  51 |         form.submit();
  52 |     });
  53 |     
  54 |     await expect(page).toHaveURL('/');
  55 |   });
  56 | 
  57 |   test('Customer Login', async ({ page }) => {
  58 |     await page.goto('/login');
  59 |     await page.fill('input[name="email"]', 'customer@smart-umkm.test');
  60 |     await page.fill('input[name="password"]', 'password');
  61 |     await page.click('button[type="submit"]');
  62 | 
  63 |     // Should redirect to customer dashboard
  64 |     await expect(page).toHaveURL(/\/customer\/dashboard/);
  65 |   });
  66 | 
  67 |   test('Owner Login', async ({ page }) => {
  68 |     await page.goto('/login');
  69 |     await page.fill('input[name="email"]', 'owner@smart-umkm.test');
  70 |     await page.fill('input[name="password"]', 'password');
  71 |     await page.click('button[type="submit"]');
  72 | 
  73 |     // Should redirect to owner dashboard
  74 |     await expect(page).toHaveURL(/\/dashboard/);
  75 |   });
  76 | 
  77 | });
  78 | 
```