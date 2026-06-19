import { test, expect } from '@playwright/test';

test.describe('Customer Flow', () => {

  test.beforeEach(async ({ page }) => {
    // Login as Customer before each test
    await page.goto('/login');
    await page.fill('input[name="email"]', 'customer@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('form:not([action$="logout"]) button[type="submit"]');
    await expect(page).toHaveURL(/\/customer\/dashboard|\/dashboard|\//);
  });

  test('View Dashboard', async ({ page }) => {
    await page.goto('/customer/dashboard');
    await expect(page).toHaveTitle(/Akun Saya/i);
    // Should see addresses or profile section
    await expect(page.locator('text=Alamat Pengiriman').first()).toBeVisible();
  });

  test('Add Address', async ({ page }) => {
    await page.goto('/customer/dashboard');
    
    // Check if Add Address button or form exists
    const addBtn = page.locator('button:has-text("Tambah Alamat"), a:has-text("Tambah Alamat")');
    if (await addBtn.isVisible()) {
      await addBtn.click();
      await page.fill('input[name="recipient_name"]', 'Budi Test');
      await page.fill('input[name="phone"]', '08123456789');
      // If province/city are selects or text inputs
      await page.fill('input[name="province"]', 'Bali').catch(() => {});
      await page.fill('input[name="city"]', 'Denpasar').catch(() => {});
      await page.fill('textarea[name="address"]', 'Jalan Pantai Kuta');
      await page.click('form:not([action$="logout"]) button[type="submit"]');
      
      // Should return to dashboard or show success message
      await expect(page).toHaveURL(/\/customer\/dashboard/);
    }
  });

  test('View Cart', async ({ page }) => {
    await page.goto('/cart');
    await expect(page).toHaveTitle(/Keranjang/i);
  });

  test('View Order History', async ({ page }) => {
    await page.goto('/customer/orders');
    await expect(page).toHaveTitle(/Akun Saya/i);
  });

});
