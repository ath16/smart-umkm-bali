import { test, expect } from '@playwright/test';

test.describe('Admin Flow', () => {

  test.beforeEach(async ({ page }) => {
    // Login as Admin
    await page.goto('/login');
    await page.fill('input[name="email"]', 'admin@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('form:not([action$="logout"]) button[type="submit"]');
    await expect(page).toHaveURL(/\/admin\/dashboard/);
  });

  test('View Admin Dashboard', async ({ page }) => {
    await page.goto('/admin/dashboard');
    await expect(page).toHaveTitle(/Admin|Dashboard/i);
    // Should see global metrics
    const statsContainer = page.locator('.grid, .stats');
    await expect(statsContainer.first()).toBeVisible();
  });

  test('View All Stores', async ({ page }) => {
    await page.goto('/admin/stores');
    await expect(page).toHaveTitle(/Superadmin/i);
  });

  test('Suspend Store Modal', async ({ page }) => {
    await page.goto('/admin/stores');
    
    // Check if suspend button exists
    const suspendBtn = page.locator('button:has-text("Suspend"), button:has-text("Tangguhkan")').first();
    if (await suspendBtn.isVisible()) {
      await suspendBtn.click();
      
      // Modal should appear
      const modal = page.locator('div[role="dialog"]');
      await expect(modal).toBeVisible();
      
      // Should have reason input
      const reasonInput = page.locator('textarea[name="reason"]');
      await expect(reasonInput).toBeVisible();
      
      // Close modal
      await page.keyboard.press('Escape');
    }
  });

});
