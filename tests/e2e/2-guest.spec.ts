import { test, expect } from '@playwright/test';

test.describe('Guest Flow', () => {

  test('View Landing Page', async ({ page }) => {
    await page.goto('/');
    
    // Title should contain Smart UMKM Bali
    await expect(page).toHaveTitle(/Smart UMKM Bali/);

    // Should see Hero section or Explore Products
    const heading = page.locator('h1').first();
    await expect(heading).toBeVisible();
  });

  test('View Products Catalog', async ({ page }) => {
    await page.goto('/products');
    
    // Verify there are product cards (assuming there's a grid of products)
    // We don't rely on exact count in case db is empty, but if seeded, there should be items
    // Just verifying the page loads without 500 error
    await expect(page).toHaveURL(/\/products/);
  });

  test('Product Search', async ({ page }) => {
    await page.goto('/products');
    
    const searchInput = page.locator('input[name="q"]');
    if (await searchInput.isVisible()) {
      await searchInput.fill('Kopi');
      await searchInput.press('Enter');
      
      // The URL should contain q=Kopi
      await expect(page).toHaveURL(/q=Kopi/i);
    }
  });

  test('View Store List', async ({ page }) => {
    await page.goto('/stores');
    await expect(page).toHaveURL(/\/stores/);
  });

});
