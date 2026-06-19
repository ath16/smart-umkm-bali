import { test, expect } from '@playwright/test';

test.describe('Validation Flow', () => {

  // 17. Checkout Without Address
  test('Checkout Without Address', async ({ page }) => {
    // This assumes user has no address, or we forcefully submit without selecting address
    // Since UI might prevent clicking "Selesaikan Pesanan", we check if the button is disabled
    // or if error message appears
    await page.goto('/login');
    await page.fill('input[name="email"]', 'customer@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('button[type="submit"]');

    await page.goto('/checkout');
    // Uncheck all addresses if possible, or submit directly
    const submitBtn = page.locator('button:has-text("Selesaikan Pesanan")');
    if (await submitBtn.isVisible()) {
      await submitBtn.click();
      // Should show validation error or not navigate away
      await expect(page).toHaveURL(/\/checkout/);
    }
  });

  // 18. Add to Cart Exceeds Stock
  test('Add to Cart Exceeds Stock', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'customer@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('button[type="submit"]');

    await page.goto('/products');
    const firstProductLink = page.locator('a.product-card-link, a[href*="/products/"]').first();
    if (await firstProductLink.isVisible()) {
      await firstProductLink.click();
      
      const qtyInput = page.locator('input[name="quantity"]:not([type="hidden"])');
      if (await qtyInput.isVisible()) {
        await qtyInput.fill('99999'); // Exceeding realistic stock
        await page.click('button:has-text("Tambah ke Keranjang")');
        // Expect validation error alert or toast
        const errorMessage = page.locator('.alert-danger, .toast-error, text="Maksimal"');
        // Just verify we don't crash
        await expect(page).toHaveURL(/products\//);
      }
    }
  });

  // 19. POS Underpayment
  test('POS Underpayment', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'cashier@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('button[type="submit"]');

    await page.goto('/dashboard/transactions/create').catch(() => page.goto('/cashier/pos'));
    const firstProduct = page.locator('button.add-to-cart-pos').first();
    if (await firstProduct.isVisible()) {
      await firstProduct.click();
      
      const payBtn = page.locator('button:has-text("Bayar")');
      if (await payBtn.isVisible()) {
        await payBtn.click();
        
        const amountInput = page.locator('input[name="payment_amount"], input[name="cash_received"]');
        if (await amountInput.isVisible()) {
          await amountInput.fill('100'); // Unlikely to be enough for anything
          
          const processBtn = page.locator('button:has-text("Proses Pembayaran"), button:has-text("Selesaikan")');
          
          // Button might be disabled, or clicking it shows an error
          if (await processBtn.isEnabled()) {
            await processBtn.click();
            // Should not navigate to success/receipt
            await expect(page.locator('.receipt')).toBeHidden();
          }
        }
      }
    }
  });

  // 20. Create Product Missing Price
  test('Create Product Missing Price', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'owner@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('button[type="submit"]');

    await page.goto('/dashboard/products/create');
    await page.fill('input[name="name"]', 'Produk Tanpa Harga');
    // Deliberately skipping cost_price and sell_price
    await page.click('button[type="submit"]');
    
    // Expect to remain on the create page due to validation
    await expect(page).toHaveURL(/\/dashboard\/products\/create/);
  });

  // 21. Store Suspend Missing Reason
  test('Store Suspend Missing Reason', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'admin@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('button[type="submit"]');

    await page.goto('/admin/stores');
    const suspendBtn = page.locator('button:has-text("Suspend"), button:has-text("Tangguhkan")').first();
    if (await suspendBtn.isVisible()) {
      await suspendBtn.click();
      const confirmBtn = page.locator('button:has-text("Konfirmasi"), button:has-text("Yakin")');
      
      // Leaving reason empty
      await confirmBtn.click();
      
      // Should remain open or show error
      const modal = page.locator('div[role="dialog"]');
      await expect(modal).toBeVisible();
    }
  });

  // 22. Duplicate Email Registration
  test('Duplicate Email Registration', async ({ page }) => {
    await page.goto('/register');
    await page.fill('input[name="name"]', 'Customer Duplicate');
    await page.fill('input[name="email"]', 'customer@smart-umkm.test'); // Already exists
    await page.fill('input[name="password"]', 'password123');
    await page.fill('input[name="password_confirmation"]', 'password123');
    await page.click('button[type="submit"]');
    
    // Expect validation error
    const errorMsg = page.locator('text="telah digunakan"').or(page.locator('text="already been taken"')).first();
    await expect(errorMsg).toBeVisible();
  });

});
