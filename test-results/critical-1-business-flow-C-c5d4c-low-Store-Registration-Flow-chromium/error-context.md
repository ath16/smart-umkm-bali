# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: critical/1-business-flow.spec.ts >> Critical Business Flow >> Store Registration Flow
- Location: tests/e2e/critical/1-business-flow.spec.ts:178:3

# Error details

```
Error: expect(page).toHaveURL(expected) failed

Expected pattern: /\/stores\/create/
Received string:  "http://127.0.0.1:8000/customer/dashboard"
Timeout: 5000ms

Call log:
  - Expect "toHaveURL" with timeout 5000ms
    14 × unexpected value "http://127.0.0.1:8000/customer/dashboard"

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
  - paragraph: New Owner
  - paragraph: Pembeli
  - button "Logout":
    - img
- paragraph: Selamat Datang
- heading "Halo, New Owner!" [level=1]
- main:
  - link "Pesanan Saya Lihat riwayat & status pesanan":
    - /url: http://127.0.0.1:8000/customer/orders
    - img
    - heading "Pesanan Saya" [level=3]
    - paragraph: Lihat riwayat & status pesanan
  - link "Profil Saya Kelola informasi akun Anda":
    - /url: http://127.0.0.1:8000/customer/profile
    - img
    - heading "Profil Saya" [level=3]
    - paragraph: Kelola informasi akun Anda
  - link "Alamat Pengiriman Atur alamat pengiriman Anda":
    - /url: http://127.0.0.1:8000/customer/address
    - img
    - heading "Alamat Pengiriman" [level=3]
    - paragraph: Atur alamat pengiriman Anda
  - img
  - heading "Temukan Lebih Banyak" [level=3]
  - paragraph: Jelajahi produk unik dari pengrajin lokal Bali.
  - link "Jelajahi Produk":
    - /url: http://127.0.0.1:8000/products
    - text: Jelajahi Produk
    - img
```

# Test source

```ts
  94  |     await page.goto('/cart');
  95  |     const removeBtn = page.locator('button:has-text("Hapus"), button.remove-item, a.text-red-500').first();
  96  |     if (await removeBtn.isVisible()) {
  97  |       await removeBtn.click();
  98  |       await page.waitForTimeout(500); // Wait for DOM update
  99  |       await expect(page).toHaveURL(/\/cart/);
  100 |     }
  101 |   });
  102 | 
  103 |   // 6. [Order] Status: Processing
  104 |   test('Order Status Change to Processing', async ({ page }) => {
  105 |     await page.goto('/login');
  106 |     await page.fill('input[name="email"]', 'owner@smart-umkm.test');
  107 |     await page.fill('input[name="password"]', 'password');
  108 |     await page.click('button[type="submit"]');
  109 | 
  110 |     await page.goto('/dashboard/orders');
  111 |     const orderLink = page.locator('a[href*="/dashboard/orders/"]').first();
  112 |     if (await orderLink.isVisible()) {
  113 |       await orderLink.click();
  114 |       const processBtn = page.locator('button:has-text("Proses Pesanan")');
  115 |       if (await processBtn.isVisible()) await processBtn.click();
  116 |     }
  117 |   });
  118 | 
  119 |   // 7. [Order] Status: Shipped
  120 |   test('Order Status Change to Shipped', async ({ page }) => {
  121 |     await page.goto('/login');
  122 |     await page.fill('input[name="email"]', 'owner@smart-umkm.test');
  123 |     await page.fill('input[name="password"]', 'password');
  124 |     await page.click('button[type="submit"]');
  125 | 
  126 |     await page.goto('/dashboard/orders');
  127 |     const orderLink = page.locator('a[href*="/dashboard/orders/"]').first();
  128 |     if (await orderLink.isVisible()) {
  129 |       await orderLink.click();
  130 |       const shipBtn = page.locator('button:has-text("Kirim Pesanan")');
  131 |       if (await shipBtn.isVisible()) {
  132 |         const trackingInput = page.locator('input[name="tracking_number"]');
  133 |         if (await trackingInput.isVisible()) await trackingInput.fill('RESI123456789');
  134 |         await shipBtn.click();
  135 |       }
  136 |     }
  137 |   });
  138 | 
  139 |   // 8. [Order] Status: Completed
  140 |   test('Order Status Change to Completed', async ({ page }) => {
  141 |     await page.goto('/login');
  142 |     await page.fill('input[name="email"]', 'customer@smart-umkm.test');
  143 |     await page.fill('input[name="password"]', 'password');
  144 |     await page.click('button[type="submit"]');
  145 | 
  146 |     await page.goto('/customer/orders');
  147 |     const orderLink = page.locator('a[href*="/customer/orders/"]').first();
  148 |     if (await orderLink.isVisible()) {
  149 |       await orderLink.click();
  150 |       const completeBtn = page.locator('button:has-text("Pesanan Diterima"), button:has-text("Selesaikan Pesanan")');
  151 |       if (await completeBtn.isVisible()) await completeBtn.click();
  152 |     }
  153 |   });
  154 | 
  155 |   // 9. [POS] Offline Transaction Checkout
  156 |   test('Offline Transaction Checkout', async ({ page }) => {
  157 |     await page.goto('/login');
  158 |     await page.fill('input[name="email"]', 'cashier@smart-umkm.test');
  159 |     await page.fill('input[name="password"]', 'password');
  160 |     await page.click('button[type="submit"]');
  161 | 
  162 |     await page.goto('/dashboard/transactions/create').catch(() => page.goto('/cashier/pos'));
  163 |     const firstProduct = page.locator('button.add-to-cart-pos').first();
  164 |     if (await firstProduct.isVisible()) {
  165 |       await firstProduct.click();
  166 |       const payBtn = page.locator('button:has-text("Bayar")');
  167 |       if (await payBtn.isVisible()) {
  168 |         await payBtn.click();
  169 |         const amountInput = page.locator('input[name="payment_amount"], input[name="cash_received"]');
  170 |         if (await amountInput.isVisible()) await amountInput.fill('1000000');
  171 |         await page.click('button:has-text("Proses Pembayaran"), button:has-text("Selesaikan")');
  172 |         await expect(page.locator('.invoice-modal, .receipt')).toBeVisible();
  173 |       }
  174 |     }
  175 |   });
  176 | 
  177 |   // 10. [Store] Registration Flow
  178 |   test('Store Registration Flow', async ({ page }) => {
  179 |     const uniqueEmail = `new_owner_${Date.now()}@example.com`;
  180 |     
  181 |     // Register
  182 |     await page.goto('/register');
  183 |     await page.fill('input[name="name"]', 'New Owner');
  184 |     await page.fill('input[name="email"]', uniqueEmail);
  185 |     await page.fill('input[name="password"]', 'password123');
  186 |     await page.fill('input[name="password_confirmation"]', 'password123');
  187 |     
  188 |     const roleSelect = page.locator('select[name="role"]');
  189 |     if (await roleSelect.isVisible()) await roleSelect.selectOption('owner');
  190 |     
  191 |     await page.click('button[type="submit"]');
  192 |     
  193 |     // Expect to be redirected to store creation
> 194 |     await expect(page).toHaveURL(/\/stores\/create/);
      |                        ^ Error: expect(page).toHaveURL(expected) failed
  195 |     
  196 |     // Fill Store Details
  197 |     await page.fill('input[name="name"]', 'Toko Baru Makmur');
  198 |     await page.fill('textarea[name="address"]', 'Jalan Raya Denpasar No 1');
  199 |     await page.click('button[type="submit"]');
  200 |     
  201 |     // Expect to land on dashboard
  202 |     await expect(page).toHaveURL(/\/dashboard/);
  203 |   });
  204 | 
  205 | });
  206 | 
```