import { test, expect } from '@playwright/test';

test.describe('Authentication Flow', () => {
  
  test('Customer Registration', async ({ page }) => {
    // Generate random email to avoid duplicate
    const uniqueEmail = `test_customer_${Date.now()}@example.com`;

    await page.goto('/register');
    await expect(page).toHaveTitle(/Smart UMKM/i);

    // Fill the registration form
    await page.fill('input[name="name"]', 'Budi Playwright');
    await page.fill('input[name="email"]', uniqueEmail);
    await page.fill('input[name="password"]', 'password123');
    await page.fill('input[name="password_confirmation"]', 'password123');
    
    // Select role if there is a role selector, default is customer
    // Check if role selector exists, if yes, select customer
    const roleSelect = page.locator('select[name="role"]');
    if (await roleSelect.isVisible()) {
      await roleSelect.selectOption('customer');
    }

    await page.click('form:not([action$="logout"]) button[type="submit"]');

    // Should redirect to dashboard
    await expect(page).toHaveURL(/\/customer\/dashboard|\/dashboard/);
    
    // Check that we are logged in (e.g. Profile button or Logout button is visible)
    // Wait for the navigation bar
    const nav = page.locator('nav');
    await expect(nav).toBeVisible();
    
    // Logout
    await page.goto('/customer/dashboard'); // ensure we are on a page with logout
    await page.evaluate(() => {
        // Trigger a fake POST request to logout if the button is hidden in a dropdown
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/logout';
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (csrfToken) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_token';
            input.value = csrfToken;
            form.appendChild(input);
        }
        document.body.appendChild(form);
        form.submit();
    });
    
    await expect(page).toHaveURL('/');
  });

  test('Customer Login', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'customer@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('form:not([action$="logout"]) button[type="submit"]');

    // Should redirect to customer dashboard
    await expect(page).toHaveURL(/\/customer\/dashboard/);
  });

  test('Owner Login', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'owner@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('form:not([action$="logout"]) button[type="submit"]');

    // Should redirect to owner dashboard
    await expect(page).toHaveURL(/\/dashboard/);
  });

});
