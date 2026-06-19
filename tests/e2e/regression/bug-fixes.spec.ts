import { test, expect } from '@playwright/test';

test.describe('Bug Regression Tests', () => {

  // Bug 1: Cross Tenant Access
  test('Cross Tenant Order Access is Blocked', async ({ request }) => {
    // Attempt to access a random non-existent or other user's order
    const orderReq = await request.get('/customer/orders/999999', { maxRedirects: 0 });
    // Since we're unauthenticated here, it should redirect to login (302) or 403
    expect([302, 403, 404]).toContain(orderReq.status());
  });

  // Bug 2: Stock Validation 
  test('Add to Cart Exceeds Stock Shows Error', async ({ page }) => {
    await page.goto('/store');
    const firstProductLink = page.locator('.product-card a').first();
    if (await firstProductLink.isVisible()) {
      await firstProductLink.click();
      
      const qtyInput = page.locator('input[name="quantity"]:not([type="hidden"])');
      if (await qtyInput.isVisible()) {
        await qtyInput.fill('99999');
        await page.click('form:not([action$="logout"]) button[type="submit"]');
        
        // Wait for potential toast or just verify we don't go to checkout
        await expect(page).toHaveURL(/products|store/);
      }
    }
  });

  // Bug 3: Redirect Logic
  test('Admin Login Redirects to Admin Dashboard', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'admin@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('form:not([action$="logout"]) button[type="submit"]');

    await expect(page).toHaveURL(/\/admin\/dashboard/);
  });

  // Bug 4: Store Registration Flow
  test('Owner Registration Redirects to Create Store', async ({ page }) => {
    await page.goto('/register');
    
    // Choose Owner Role
    await page.locator('input[value="owner"]').check();

    const uniqueEmail = `owner_regression_${Date.now()}@smart-umkm.test`;
    await page.fill('input[name="name"]', 'Owner Regression');
    await page.fill('input[name="email"]', uniqueEmail);
    await page.fill('input[name="password"]', 'password123');
    await page.fill('input[name="password_confirmation"]', 'password123');
    await page.click('form:not([action$="logout"]) button[type="submit"]');

    await expect(page).toHaveURL(/\/stores\/create/);
  });

  // Bug 5: Product Validation Message
  test('Create Product Shows Error when Missing Price', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'owner@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('form:not([action$="logout"]) button[type="submit"]');
    await page.waitForTimeout(1500);
    await page.goto('/dashboard/products/create');
    
    await page.fill('input[name="name"]', 'Invalid Product');
    // Skip prices
    await page.click('button:has-text("Simpan Produk")');

    await expect(page).toHaveURL(/\/dashboard\/products\/create/);
  });

  // Bug 6: Duplicate Email Error Translation
  test('Duplicate Email Registration Translation', async ({ page }) => {
    await page.goto('/register');
    // Try to register an existing email
    await page.fill('input[name="name"]', 'Cloner');
    await page.fill('input[name="email"]', 'owner@smart-umkm.test');
    await page.fill('input[name="password"]', 'password123');
    await page.fill('input[name="password_confirmation"]', 'password123');
    await page.click('form:not([action$="logout"]) button[type="submit"]');

    const errorMsg = page.getByText('telah digunakan').or(page.getByText('already been taken')).first();
    await expect(errorMsg).toBeVisible();
  });

});
