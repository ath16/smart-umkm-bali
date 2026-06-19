import { test, expect } from '@playwright/test';

test.describe('Cashier Flow', () => {

  test.beforeEach(async ({ page }) => {
    // Login as Cashier
    await page.goto('/login');
    await page.fill('input[name="email"]', 'cashier@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('form:not([action$="logout"]) button[type="submit"]');
    await expect(page).toHaveURL(/\/transactions\/create|\/dashboard/);
  });

  test('View POS Module', async ({ page }) => {
    await page.goto('/transactions/create');
    
    // Should see product search or product grid
    const posContainer = page.locator('.pos-container, #pos-app, main');
    await expect(posContainer).toBeVisible();
  });

  test('Process POS Transaction', async ({ page }) => {
    await page.goto('/transactions/create');
    
    // Attempt to add a product if grid exists
    const firstProductBtn = page.locator('button.add-to-cart-btn').first();
    if (await firstProductBtn.isVisible()) {
      await firstProductBtn.click();
      
      // Attempt checkout
      const payBtn = page.locator('button:has-text("Bayar")');
      await expect(payBtn).toBeVisible();
      await payBtn.click();
      
      // Verify payment modal
      const paymentModal = page.locator('.payment-modal, #paymentModal');
      await expect(paymentModal).toBeVisible();
    }
  });

  test('View Transaction History', async ({ page }) => {
    await page.goto('/transactions');
  });

});
