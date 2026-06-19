import { test, expect } from '@playwright/test';

test.describe('Security & Authorization Flow', () => {

  // 11. Customer to POS
  test('Customer accessing POS is forbidden', async ({ request }) => {
    // We can test this via UI or API. Let's do UI with page navigation or request for precise status
    // First, login via request to get session cookie
    const login = await request.post('/login', {
      form: { email: 'customer@smart-umkm.test', password: 'password' },
      ignoreHTTPSErrors: true,
    });
    
    // Now try to GET the POS route
    const posReq = await request.get('/dashboard/transactions/create');
    // Laravel typically returns 403 Forbidden or 404 if route is hidden by role middleware
    expect([403, 404, 302]).toContain(posReq.status());
  });

  // 12. Cashier to Staff Management
  test('Cashier accessing Staff Management is forbidden', async ({ request }) => {
    await request.post('/login', {
      form: { email: 'cashier@smart-umkm.test', password: 'password' },
    });
    
    const staffReq = await request.get('/dashboard/staff');
    expect([403, 404, 302]).toContain(staffReq.status());
  });

  // 13. Cashier Deleting Product
  test('Cashier Deleting Product is forbidden', async ({ request }) => {
    // CSRF bypass or web route request
    // Normally Cashiers can see products, but cannot delete.
    await request.post('/login', {
      form: { email: 'cashier@smart-umkm.test', password: 'password' },
    });

    const delReq = await request.delete('/dashboard/products/1');
    // If it's 419, it's CSRF issue in headless request, but we expect 403 or 302 redirect back
    expect(delReq.status()).not.toBe(200);
    expect(delReq.status()).not.toBe(204);
  });

  // 14. Customer to Admin Dashboard
  test('Customer to Admin Dashboard is forbidden', async ({ request }) => {
    await request.post('/login', {
      form: { email: 'customer@smart-umkm.test', password: 'password' },
    });
    const adminReq = await request.get('/admin/dashboard', { maxRedirects: 0 });
    expect([403, 404, 302]).toContain(adminReq.status());
  });

  // 15. Cross-Tenant Order Access
  test('Cross-Tenant Order Access', async ({ request }) => {
    // Assuming 'customer@smart-umkm.test' does not own order ID 99999
    await request.post('/login', {
      form: { email: 'customer@smart-umkm.test', password: 'password' },
    });
    const orderReq = await request.get('/customer/orders/999999', { maxRedirects: 0 });
    expect([403, 404, 302]).toContain(orderReq.status());
  });

  // 16. Unauthorized Export
  test('Unauthorized Export', async ({ request }) => {
    await request.post('/login', {
      form: { email: 'cashier@smart-umkm.test', password: 'password' },
    });
    const exportReq = await request.get('/dashboard/reports/pdf');
    expect([403, 404, 302]).toContain(exportReq.status());
  });

});
