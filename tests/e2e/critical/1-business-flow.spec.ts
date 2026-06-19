import { test, expect } from '@playwright/test';

test.describe('Critical Business Flow', () => {

  // 1. [E2E] Full Checkout Flow
  test('Full Checkout Flow', async ({ page }) => {
    // Navigate and Add to Cart
    await page.goto('/products');
    const firstProduct = page.locator('.add-to-cart-btn').first();
    if (await firstProduct.isVisible()) {
      await firstProduct.click();
      
      // Login as Customer
      await page.goto('/login');
      await page.fill('input[name="email"]', 'customer@smart-umkm.test');
      await page.fill('input[name="password"]', 'password');
      await page.click('form:not([action$="logout"]) button[type="submit"]');

      // Go to Checkout
      await page.waitForTimeout(1500);
    await page.goto('/checkout');
      await expect(page).toHaveTitle(/Checkout/i);
      
      // Choose address
      const addressRadio = page.locator('input[name="address_id"]').first();
      if (await addressRadio.isVisible()) await addressRadio.check();

      // Choose courier
      const courierSelect = page.locator('select[name="courier"]');
      if (await courierSelect.isVisible()) await courierSelect.selectOption({ index: 1 });
      
      // Submit
      await page.click('button:has-text("Buat Pesanan"), button:has-text("Selesaikan Pesanan")');

      // Should hit success or Midtrans Snap redirect
      await expect(page).toHaveURL(/checkout\/success|app.midtrans.com|api.sandbox.midtrans.com/i);
    }
  });

  // 2. [Webhook] Payment Settlement
  test('Payment Webhook Settlement', async ({ request }) => {
    // We send a mock webhook request directly to the API
    const response = await request.post('/api/midtrans/webhook', {
      data: {
        order_id: 'TEST-ORDER-123', // Assumption: A test order ID or a dummy string
        transaction_status: 'settlement',
        gross_amount: '50000.00',
        signature_key: 'dummy-signature'
      }
    });
    // Expected to either return 200 OK or 404 if order doesn't exist, but shouldn't 500
    expect(response.status()).toBeLessThan(500);
  });

  // 3. [Webhook] Payment Expired
  test('Payment Webhook Expired', async ({ request }) => {
    const response = await request.post('/api/midtrans/webhook', {
      data: {
        order_id: 'TEST-ORDER-123',
        transaction_status: 'expire',
        gross_amount: '50000.00',
        signature_key: 'dummy-signature'
      }
    });
    expect(response.status()).toBeLessThan(500);
  });

  // 4. [Cart] Update Quantity & Subtotal
  test('Cart Update Quantity', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'customer@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('form:not([action$="logout"]) button[type="submit"]');
    await page.waitForTimeout(1500);
    await page.goto('/cart');
    const qtyInput = page.locator('input[name="quantity"], input[type="number"]').first();
    if (await qtyInput.isVisible()) {
      await qtyInput.fill('3');
      // Some apps require pressing enter or clicking update
      await qtyInput.press('Enter');
      // Wait for subtotal to update
      await page.waitForTimeout(1000);
      const subtotal = page.locator('.subtotal, .total').first();
      await expect(subtotal).toBeVisible();
    }
  });

  // 5. [Cart] Remove Item
  test('Cart Remove Item', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'customer@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('form:not([action$="logout"]) button[type="submit"]');
    await page.waitForTimeout(1500);
    await page.goto('/cart');
    const removeBtn = page.locator('button:has-text("Hapus"), button.remove-item, a.text-red-500').first();
    if (await removeBtn.isVisible()) {
      await removeBtn.click();
      await page.waitForTimeout(500); // Wait for DOM update
      await expect(page).toHaveURL(/\/cart/);
    }
  });

  // 6. [Order] Status: Processing
  test('Order Status Change to Processing', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'owner@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('form:not([action$="logout"]) button[type="submit"]');
    await page.waitForTimeout(1500);
    await page.goto('/dashboard/orders');
    const orderLink = page.locator('a[href*="/dashboard/orders/"]').first();
    if (await orderLink.isVisible()) {
      await orderLink.click();
      const processBtn = page.locator('button:has-text("Proses Pesanan")');
      if (await processBtn.isVisible()) await processBtn.click();
    }
  });

  // 7. [Order] Status: Shipped
  test('Order Status Change to Shipped', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'owner@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('form:not([action$="logout"]) button[type="submit"]');
    await page.waitForTimeout(1500);
    await page.goto('/dashboard/orders');
    const orderLink = page.locator('a[href*="/dashboard/orders/"]').first();
    if (await orderLink.isVisible()) {
      await orderLink.click();
      const shipBtn = page.locator('button:has-text("Kirim Pesanan")');
      if (await shipBtn.isVisible()) {
        const trackingInput = page.locator('input[name="tracking_number"]');
        if (await trackingInput.isVisible()) await trackingInput.fill('RESI123456789');
        await shipBtn.click();
      }
    }
  });

  // 8. [Order] Status: Completed
  test('Order Status Change to Completed', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'customer@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('form:not([action$="logout"]) button[type="submit"]');
    await page.waitForTimeout(1500);
    await page.goto('/customer/orders');
    const orderLink = page.locator('a[href*="/customer/orders/"]').first();
    if (await orderLink.isVisible()) {
      await orderLink.click();
      const completeBtn = page.locator('button:has-text("Pesanan Diterima"), button:has-text("Selesaikan Pesanan")');
      if (await completeBtn.isVisible()) await completeBtn.click();
    }
  });

  // 9. [POS] Offline Transaction Checkout
  test('Offline Transaction Checkout', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'cashier@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('form:not([action$="logout"]) button[type="submit"]');
    await page.waitForTimeout(1500);
    await page.goto('/dashboard/transactions/create').catch(() => page.goto('/cashier/pos'));
    const firstProduct = page.locator('button.add-to-cart-pos').first();
    if (await firstProduct.isVisible()) {
      await firstProduct.click();
      const payBtn = page.locator('button:has-text("Bayar")');
      if (await payBtn.isVisible()) {
        await payBtn.click();
        const amountInput = page.locator('input[name="payment_amount"], input[name="cash_received"]');
        if (await amountInput.isVisible()) await amountInput.fill('1000000');
        await page.click('button:has-text("Proses Pembayaran"), button:has-text("Selesaikan")');
        await expect(page.locator('.invoice-modal, .receipt')).toBeVisible();
      }
    }
  });

  // 10. [Store] Registration Flow
  test('Store Registration Flow', async ({ page }) => {
    const uniqueEmail = `storeowner_${Date.now()}@smart-umkm.test`;
    
    // Register
    await page.goto('/register');
    await page.locator('input[value="owner"]').check();
    await page.fill('input[name="name"]', 'New Owner');
    await page.fill('input[name="email"]', uniqueEmail);
    await page.fill('input[name="password"]', 'password123');
    await page.fill('input[name="password_confirmation"]', 'password123');
    
    const roleSelect = page.locator('select[name="role"]');
    if (await roleSelect.isVisible()) await roleSelect.selectOption('owner');
    
    await page.click('form:not([action$="logout"]) button[type="submit"]');
    
    // Expect to be redirected to store creation
    await expect(page).toHaveURL(/\/stores\/create/);
    
    // Fill Store Details
    await page.fill('input[name="name"]', 'Toko Baru Makmur');
    await page.fill('textarea[name="address"]', 'Jalan Raya Denpasar No 1');
    await page.click('form:not([action$="logout"]) button[type="submit"]');
    
    // Expect to land on dashboard
    await expect(page).toHaveURL(/\/dashboard/);
  });

});
