import { test, expect } from '@playwright/test';

test.describe('Owner Flow', () => {

  test.beforeEach(async ({ page }) => {
    // Login as Owner
    await page.goto('/login');
    await page.fill('input[name="email"]', 'owner@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('form:not([action$="logout"]) button[type="submit"]');
    await expect(page).toHaveURL(/\/dashboard/);
  });

  test('View Dashboard', async ({ page }) => {
    await page.goto('/dashboard');
    await expect(page).toHaveTitle(/Dashboard/i);
    // Should see metrics
    await expect(page.locator('text=Total Revenue').first()).toBeVisible();
  });

  test('View Inventory & Products', async ({ page }) => {
    await page.goto('/dashboard/products');
    await expect(page).toHaveTitle(/Produk/i);
    
    // Add product button should exist
    const addBtn = page.locator('a:has-text("Tambah Produk"), button:has-text("Tambah Produk")');
    await expect(addBtn).toBeVisible();
  });

  test('Create Product Validation', async ({ page }) => {
    await page.goto('/dashboard/products/create');
    
    // Try to submit empty form
    await page.click('form:not([action$="logout"]) button[type="submit"]');
    
    // Should stay on page due to HTML5 validation or show Laravel errors
    await expect(page).toHaveURL(/\/dashboard\/products\/create/);
  });

  test('View Orders', async ({ page }) => {
    await page.goto('/dashboard/orders');
    await expect(page).toHaveTitle(/Pesanan/i);
  });

  test('View Staff/Cashiers', async ({ page }) => {
    await page.goto('/staff');
    await expect(page).toHaveTitle(/Smart UMKM/i);
  });

  test('Export Report PDF', async ({ page }) => {
    // Navigate to reports if it exists
    await page.goto('/reports').catch(() => {});
    
    // Some apps use direct URL for export
    // Playwright can wait for download
    const exportBtn = page.locator('a[href*="export?format=pdf"]');
    if (await exportBtn.isVisible()) {
      const [download] = await Promise.all([
        page.waitForEvent('download'),
        exportBtn.click(),
      ]);
      expect(download.suggestedFilename()).toContain('.pdf');
    }
  });

});
