# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: critical/2-security-authz.spec.ts >> Security & Authorization Flow >> Cross-Tenant Order Access
- Location: tests/e2e/critical/2-security-authz.spec.ts:54:3

# Error details

```
Error: expect(received).toContain(expected) // indexOf

Expected value: 200
Received array: [403, 404]
```

# Test source

```ts
  1  | import { test, expect } from '@playwright/test';
  2  | 
  3  | test.describe('Security & Authorization Flow', () => {
  4  | 
  5  |   // 11. Customer to POS
  6  |   test('Customer accessing POS is forbidden', async ({ request }) => {
  7  |     // We can test this via UI or API. Let's do UI with page navigation or request for precise status
  8  |     // First, login via request to get session cookie
  9  |     const login = await request.post('/login', {
  10 |       form: { email: 'customer@smart-umkm.test', password: 'password' },
  11 |       ignoreHTTPSErrors: true,
  12 |     });
  13 |     
  14 |     // Now try to GET the POS route
  15 |     const posReq = await request.get('/dashboard/transactions/create');
  16 |     // Laravel typically returns 403 Forbidden or 404 if route is hidden by role middleware
  17 |     expect([403, 404, 302]).toContain(posReq.status());
  18 |   });
  19 | 
  20 |   // 12. Cashier to Staff Management
  21 |   test('Cashier accessing Staff Management is forbidden', async ({ request }) => {
  22 |     await request.post('/login', {
  23 |       form: { email: 'cashier@smart-umkm.test', password: 'password' },
  24 |     });
  25 |     
  26 |     const staffReq = await request.get('/dashboard/staff');
  27 |     expect([403, 404, 302]).toContain(staffReq.status());
  28 |   });
  29 | 
  30 |   // 13. Cashier Deleting Product
  31 |   test('Cashier Deleting Product is forbidden', async ({ request }) => {
  32 |     // CSRF bypass or web route request
  33 |     // Normally Cashiers can see products, but cannot delete.
  34 |     await request.post('/login', {
  35 |       form: { email: 'cashier@smart-umkm.test', password: 'password' },
  36 |     });
  37 | 
  38 |     const delReq = await request.delete('/dashboard/products/1');
  39 |     // If it's 419, it's CSRF issue in headless request, but we expect 403 or 302 redirect back
  40 |     expect(delReq.status()).not.toBe(200);
  41 |     expect(delReq.status()).not.toBe(204);
  42 |   });
  43 | 
  44 |   // 14. Customer to Admin Dashboard
  45 |   test('Customer to Admin Dashboard is forbidden', async ({ request }) => {
  46 |     await request.post('/login', {
  47 |       form: { email: 'customer@smart-umkm.test', password: 'password' },
  48 |     });
  49 |     const adminReq = await request.get('/admin/dashboard', { maxRedirects: 0 });
  50 |     expect([403, 404, 302]).toContain(adminReq.status());
  51 |   });
  52 | 
  53 |   // 15. Cross-Tenant Order Access
  54 |   test('Cross-Tenant Order Access', async ({ request }) => {
  55 |     // Assuming 'customer@smart-umkm.test' does not own order ID 99999
  56 |     await request.post('/login', {
  57 |       form: { email: 'customer@smart-umkm.test', password: 'password' },
  58 |     });
  59 |     const orderReq = await request.get('/customer/orders/999999', { maxRedirects: 0 });
> 60 |     expect([403, 404, 302]).toContain(orderReq.status());
     |                        ^ Error: expect(received).toContain(expected) // indexOf
  61 |   });
  62 | 
  63 |   // 16. Unauthorized Export
  64 |   test('Unauthorized Export', async ({ request }) => {
  65 |     await request.post('/login', {
  66 |       form: { email: 'cashier@smart-umkm.test', password: 'password' },
  67 |     });
  68 |     const exportReq = await request.get('/dashboard/reports/pdf');
  69 |     expect([403, 404, 302]).toContain(exportReq.status());
  70 |   });
  71 | 
  72 | });
  73 | 
```