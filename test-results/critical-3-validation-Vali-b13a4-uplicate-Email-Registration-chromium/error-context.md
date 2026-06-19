# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: critical/3-validation.spec.ts >> Validation Flow >> Duplicate Email Registration
- Location: tests/e2e/critical/3-validation.spec.ts:121:3

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
  - text: Customer Duplicate
- text: Mendaftar sebagai
- radio "Pelanggan" [checked]
- text: Pelanggan
- radio "Pemilik Usaha (UMKM)"
- text: Pemilik Usaha (UMKM) Email
- textbox "Email":
  - /placeholder: contoh@email.com
  - text: customer@smart-umkm.test
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
> 131 |     await expect(errorMsg).toBeVisible();
      |                            ^ Error: expect(locator).toBeVisible() failed
  132 |   });
  133 | 
  134 | });
  135 | 
```