# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: 6-admin.spec.ts >> Admin Flow >> View All Stores
- Location: tests/e2e/6-admin.spec.ts:22:3

# Error details

```
Error: expect(page).toHaveTitle(expected) failed

Expected pattern: /Toko|Store/i
Received string:  "Smart UMKM Bali"
Timeout: 5000ms

Call log:
  - Expect "toHaveTitle" with timeout 5000ms
    13 × unexpected value "Smart UMKM Bali"

```

```yaml
- img
- text: Internal Server Error
- button "Copy as Markdown":
  - img
  - text: Copy as Markdown
- heading "Illuminate\\Database\\Eloquent\\RelationNotFoundException" [level=1]
- text: vendor/laravel/framework/src/Illuminate/Database/Eloquent/RelationNotFoundException.php:35
- paragraph: Call to undefined relationship [user] on model [App\Models\Store].
- text: LARAVEL 13.15.0 PHP 8.4.1
- img
- text: UNHANDLED CODE 0
- img
- text: "500"
- img
- text: GET http://127.0.0.1:8000/admin/stores
- button:
  - img
- img
- heading "Exception trace" [level=3]
- img
- text: 8 vendor frames
- button:
  - img
- code: Illuminate\Database\Eloquent\Builder->paginate(integer)
- text: app/Http/Controllers/Admin/StoreController.php:28
- button:
  - img
- code: "23 $q->where('is_active', true); 24 }); 25 } 26 } 27 28 $stores = $query->paginate(20)->withQueryString(); 29 30 return view('admin.stores.index', compact('stores')); 31 } 32 33 public function suspend(Request $request, Store $store) 34 { 35 $request->validate([ 36 'reason' => 'required|string|max:1000' 37 ]); 38 39 if (!$store->isSuspended()) { 40"
- img
- text: 5 vendor frames
- button:
  - img
- code: "Illuminate\\Pipeline\\Pipeline->{closure:Illuminate\\Pipeline\\Pipeline::prepareDestination():178}(object(Illuminate\\Http\\Request))"
- text: app/Http/Middleware/RoleMiddleware.php:21
- button:
  - img
- img
- text: 47 vendor frames
- button:
  - img
- code: Illuminate\Foundation\Application->handleRequest(object(Illuminate\Http\Request))
- text: public/index.php:20
- button:
  - img
- img
- text: 1 vendor frame
- button:
  - img
- img
- heading "Queries" [level=3]
- text: 1-4 of 4
- img
- text: mysql
- code: "select * from `sessions` where `id` = 'MhHdNU0k3yXhz3XfcsMsRxguhfcumRufgFa015rH' limit 1"
- text: 2.26ms
- img
- text: mysql
- code: "select * from `users` where `id` = 1 and `users`.`deleted_at` is null limit 1"
- text: 0.38ms
- img
- text: mysql
- code: "select count(*) as `aggregate` from `stores` where `stores`.`deleted_at` is null"
- text: 2.93ms
- img
- text: mysql
- code: "select * from `stores` where `stores`.`deleted_at` is null limit 20 offset 0"
- text: 0.26ms
- heading "Headers" [level=2]
- text: host 127.0.0.1:8000 connection keep-alive sec-ch-ua "HeadlessChrome";v="149", "Chromium";v="149", "Not)A;Brand";v="24" sec-ch-ua-mobile ?0 sec-ch-ua-platform "Windows" upgrade-insecure-requests 1 user-agent Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36 accept-language en-US accept text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7 sec-fetch-site none sec-fetch-mode navigate sec-fetch-user ?1 sec-fetch-dest document accept-encoding gzip, deflate, br, zstd cookie XSRF-TOKEN=eyJpdiI6IkpBSUlxR3FRdGRXRk9jaUt2N1pDNXc9PSIsInZhbHVlIjoiWGZMS2ljdDY0L3l0U1JnenJOenhPOUFRem1hemJ6ajV2M1BvLzZXeDhld3NxZmNycElBc1lHQi9wNUJFTE0wOUxxQ3dXMnAwa2NhempVampadTZkd1VWRmlGOC9FdjJKTkZKRkRQQnVMb1RualppdDJoakFGOE5Xb21XcVN3NUYiLCJtYWMiOiI4MGMyN2NiYTlhOTMxMGNlZTQwMjkyYjliODJhMWFhYmRjMzdjNDY5YmY0NDI2NTVkYzZlYmMxYzI5N2UwMjAyIiwidGFnIjoiIn0%3D; smart-umkm-bali-session=eyJpdiI6IkQzVlV2Z1RiWFp6blBjM1pyTTk1TEE9PSIsInZhbHVlIjoiNlR6cGtlRW96WlU1SFdITHkwRTJYR3JBU1U3UWkwdDNpeis1QmZJZzZtdmFqN0xsNkpmZWpINE9tKzJTQ0dBMzRqUnJrVUY0NlpuRHRFK1B3T0kyeGR5bXowM09Bek9ZL0VBVEdtQUZQN1RZc2FnbHplKzdYTjlqWGtiaVZkanUiLCJtYWMiOiJlZDU2ODYxN2E0NzBhNmEzMmFmZjU0MDNjZjMyOTkzMzcxMTcxMTFhODViNDA1NzY5NDhjYzk0NzQ5YmFkNGIwIiwidGFnIjoiIn0%3D
- heading "Body" [level=2]
- text: // No request body
- heading "Routing" [level=2]
- text: controller App\Http\Controllers\Admin\StoreController@index route name admin.stores.index middleware web, auth, verified, role:admin
- heading "Routing parameters" [level=2]
- text: // No routing parameters
- img
- img
```

# Test source

```ts
  1  | import { test, expect } from '@playwright/test';
  2  | 
  3  | test.describe('Admin Flow', () => {
  4  | 
  5  |   test.beforeEach(async ({ page }) => {
  6  |     // Login as Admin
  7  |     await page.goto('/login');
  8  |     await page.fill('input[name="email"]', 'admin@smart-umkm.test');
  9  |     await page.fill('input[name="password"]', 'password');
  10 |     await page.click('button[type="submit"]');
  11 |     await expect(page).toHaveURL(/\/admin\/dashboard/);
  12 |   });
  13 | 
  14 |   test('View Admin Dashboard', async ({ page }) => {
  15 |     await page.goto('/admin/dashboard');
  16 |     await expect(page).toHaveTitle(/Admin|Dashboard/i);
  17 |     // Should see global metrics
  18 |     const statsContainer = page.locator('.grid, .stats');
  19 |     await expect(statsContainer.first()).toBeVisible();
  20 |   });
  21 | 
  22 |   test('View All Stores', async ({ page }) => {
  23 |     await page.goto('/admin/stores');
> 24 |     await expect(page).toHaveTitle(/Toko|Store/i);
     |                        ^ Error: expect(page).toHaveTitle(expected) failed
  25 |   });
  26 | 
  27 |   test('Suspend Store Modal', async ({ page }) => {
  28 |     await page.goto('/admin/stores');
  29 |     
  30 |     // Check if suspend button exists
  31 |     const suspendBtn = page.locator('button:has-text("Suspend"), button:has-text("Tangguhkan")').first();
  32 |     if (await suspendBtn.isVisible()) {
  33 |       await suspendBtn.click();
  34 |       
  35 |       // Modal should appear
  36 |       const modal = page.locator('div[role="dialog"]');
  37 |       await expect(modal).toBeVisible();
  38 |       
  39 |       // Should have reason input
  40 |       const reasonInput = page.locator('textarea[name="reason"]');
  41 |       await expect(reasonInput).toBeVisible();
  42 |       
  43 |       // Close modal
  44 |       await page.keyboard.press('Escape');
  45 |     }
  46 |   });
  47 | 
  48 | });
  49 | 
```