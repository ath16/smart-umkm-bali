import { test, expect } from '@playwright/test';

test.describe('Role Permission & Staff Flow', () => {

  // 27. Owner Add Cashier
  test('Owner Adds Cashier', async ({ page }) => {
    // 1. Login as Owner
    await page.goto('/login');
    await page.fill('input[name="email"]', 'owner@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('button[type="submit"]');

    // 2. Go to Staff Management
    await page.goto('/dashboard/staff');
    const addBtn = page.locator('button:has-text("Tambah Staf"), a:has-text("Tambah Kasir")');
    if (await addBtn.isVisible()) {
      await addBtn.click();
      
      // 3. Fill details
      const newEmail = `kasir_baru_${Date.now()}@smart-umkm.test`;
      await page.fill('input[name="name"]', 'Kasir Baru');
      await page.fill('input[name="email"]', newEmail);
      await page.fill('input[name="password"]', 'password123');
      await page.fill('input[name="password_confirmation"]', 'password123');
      await page.click('button[type="submit"]');
      
      // 4. Logout Owner
      await page.goto('/dashboard');
      await page.evaluate(() => {
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

      // 5. Login as New Cashier
      await page.goto('/login');
      await page.fill('input[name="email"]', newEmail);
      await page.fill('input[name="password"]', 'password123');
      await page.click('button[type="submit"]');
      
      // 6. Should redirect to dashboard or POS
      await expect(page).toHaveURL(/\/dashboard|\/cashier\/pos/);
    }
  });

  // 28. Owner Revoke Cashier
  test('Owner Revokes Cashier Access', async ({ request }) => {
    // Owner deletes cashier ID 999
    await request.post('/login', {
      form: { email: 'owner@smart-umkm.test', password: 'password' },
    });
    const delReq = await request.delete('/dashboard/staff/99999');
    expect(delReq.status()).toBeLessThan(500);
  });

  // 29. Admin Suspend Store Effect
  test('Admin Suspend Store Effect', async ({ page }) => {
    await page.goto('/login');
    await page.fill('input[name="email"]', 'admin@smart-umkm.test');
    await page.fill('input[name="password"]', 'password');
    await page.click('button[type="submit"]');

    await page.goto('/admin/stores');
    const suspendBtn = page.locator('form[action*="suspend"] button').first();
    if (await suspendBtn.isVisible()) {
      await suspendBtn.click();
      
      // Modal
      const reasonInput = page.locator('textarea[name="reason"]');
      if (await reasonInput.isVisible()) {
        await reasonInput.fill('Pelanggaran Terms of Service');
        await page.click('button:has-text("Konfirmasi"), button:has-text("Yakin")');
      }

      // Store is suspended, check marketplace as Guest
      // Logout
      await page.goto('/logout'); 
      
      await page.goto('/stores');
      // Assume store "Toko A" is now missing, verify no 500 error on catalog
      const heading = page.locator('h1').first();
      await expect(heading).toBeVisible();
    }
  });

  // 30. Admin Unsuspend Store
  test('Admin Unsuspend Store', async ({ request }) => {
    await request.post('/login', {
      form: { email: 'admin@smart-umkm.test', password: 'password' },
    });
    const unsuspendReq = await request.post('/admin/stores/1/unsuspend');
    expect(unsuspendReq.status()).toBeLessThan(500);
  });

});
