# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: 4-owner.spec.ts >> Owner Flow >> View Dashboard
- Location: tests/e2e/4-owner.spec.ts:14:3

# Error details

```
Error: expect(page).toHaveTitle(expected) failed

Expected pattern: /Dashboard/i
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
- heading "Error" [level=1]
- text: resources/views/dashboard.blade.php:73
- paragraph: The script tried to call a method on an incomplete object. Please ensure that the class definition "Illuminate\Support\Collection" of the object you are trying to operate on was loaded _before_ unserialize() gets called or provide an autoloader to load the class definition
- text: LARAVEL 13.15.0 PHP 8.4.1
- img
- text: UNHANDLED CODE 0
- img
- text: "500"
- img
- text: GET http://127.0.0.1:8000/dashboard
- button:
  - img
- img
- heading "Exception trace" [level=3]
- code: require()
- text: resources/views/dashboard.blade.php:73
- button:
  - img
- code: "68 {{-- Business Insights --}} 69 <div class=\"grid grid-cols-1 md:grid-cols-3 gap-4 mb-6\"> 70 {{-- Produk Terlaris --}} 71 <div class=\"bg-white rounded-xl border border-slate-200 shadow-sm p-5\"> 72 <h3 class=\"text-sm font-semibold text-slate-900 mb-3\">Produk Terlaris</h3> 73 @if($topProducts->count() > 0) 74 <div class=\"space-y-2.5\"> 75 @foreach($topProducts as $idx => $prod) 76 <div class=\"flex items-center justify-between\"> 77 <span class=\"text-xs text-slate-600 flex items-center gap-2\"> 78 <span class=\"w-5 h-5 rounded bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500\">{{ $idx + 1 }}</span> 79 <span class=\"line-clamp-1\">{{ $prod->name }}</span> 80 </span> 81 <span class=\"text-[11px] font-medium bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full tabular-nums\">{{ $prod->total_quantity }}</span> 82 </div> 83 @endforeach 84 </div> 85"
- img
- text: 59 vendor frames
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
- code: "select * from `sessions` where `id` = '8DWPkeGWsTQx0XJjLi0aPoOKvN3GO0YqirixwLKy' limit 1"
- text: 2.63ms
- img
- text: mysql
- code: "select * from `users` where `id` = 2 and `users`.`deleted_at` is null limit 1"
- text: 0.37ms
- img
- text: mysql
- code: "select * from `stores` where `stores`.`user_id` = 2 and `stores`.`user_id` is not null and `stores`.`deleted_at` is null limit 1"
- text: 0.38ms
- img
- text: mysql
- code: "select * from `cache` where `key` in ('smart-umkm-bali-cache-store_1_dashboard_data')"
- text: 1.14ms
- heading "Headers" [level=2]
- text: host 127.0.0.1:8000 connection keep-alive sec-ch-ua "HeadlessChrome";v="149", "Chromium";v="149", "Not)A;Brand";v="24" sec-ch-ua-mobile ?0 sec-ch-ua-platform "Windows" upgrade-insecure-requests 1 user-agent Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36 accept-language en-US accept text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7 sec-fetch-site none sec-fetch-mode navigate sec-fetch-user ?1 sec-fetch-dest document accept-encoding gzip, deflate, br, zstd cookie XSRF-TOKEN=eyJpdiI6IjBjRDd5YnpWZXQyYmZTbVIvTGIrcmc9PSIsInZhbHVlIjoiek15YVJWQjRPVDcvN3pHbnFPYVV6SG1NUzdVRWhabjNEODdXZ0JYUk41UXFiZmJOS2ZZSU1DWGE2bTBiUlRLRTZhaXlFSllUaVhjdGNmMzFsa2ZFZHFObFl1MVFNTWRpK0J3eWoweUUvM0NCRkdXR20ydEQ4WjdpazJ1RHJBU3UiLCJtYWMiOiI4NjJjNGE4M2QyNTM1YWQxYWI1NzQ5YjZhYjllYWI2YjZlYWFiZTRiMDI5MWQxZmJkMjFhMGRiNTQ5MWE3NzM2IiwidGFnIjoiIn0%3D; smart-umkm-bali-session=eyJpdiI6IlZFUGk4R3lFRzlRRjE5YXFpZ2lObWc9PSIsInZhbHVlIjoiU3BWL29zRWJtY1dNa1BxZEx1QTVzQURhdEp2WXVaNWlXakdMbEQ4Qzk1TmhwSG9pb1djcWtVVmpXQ2JueE5qdU9xS3lWZHR2cVUvSDFSQm01eWYvL3pnRWw1eEhtOGRKWm5jSk5jcXlxSVJOcU1DcTRFb3BxUlYrVE9jOGU4VVoiLCJtYWMiOiI3ZTIwMzllZTY0YThhNWE2NWQzYjcyOThiZjZhOGJiY2Q2OTZkYTBkZGMzNGVlZTdjYWNlNzU5MWYwM2IwYzM2IiwidGFnIjoiIn0%3D
- heading "Body" [level=2]
- text: // No request body
- heading "Routing" [level=2]
- text: controller App\Http\Controllers\DashboardController@index route name dashboard middleware web, auth, verified
- heading "Routing parameters" [level=2]
- text: // No routing parameters
- img
- img
```

# Test source

```ts
  1  | import { test, expect } from '@playwright/test';
  2  | 
  3  | test.describe('Owner Flow', () => {
  4  | 
  5  |   test.beforeEach(async ({ page }) => {
  6  |     // Login as Owner
  7  |     await page.goto('/login');
  8  |     await page.fill('input[name="email"]', 'owner@smart-umkm.test');
  9  |     await page.fill('input[name="password"]', 'password');
  10 |     await page.click('button[type="submit"]');
  11 |     await expect(page).toHaveURL(/\/dashboard/);
  12 |   });
  13 | 
  14 |   test('View Dashboard', async ({ page }) => {
  15 |     await page.goto('/dashboard');
> 16 |     await expect(page).toHaveTitle(/Dashboard/i);
     |                        ^ Error: expect(page).toHaveTitle(expected) failed
  17 |     // Should see metrics
  18 |     await expect(page.locator('text=Total Penjualan').first()).toBeVisible();
  19 |   });
  20 | 
  21 |   test('View Inventory & Products', async ({ page }) => {
  22 |     await page.goto('/dashboard/products');
  23 |     await expect(page).toHaveTitle(/Produk/i);
  24 |     
  25 |     // Add product button should exist
  26 |     const addBtn = page.locator('a:has-text("Tambah Produk"), button:has-text("Tambah Produk")');
  27 |     await expect(addBtn).toBeVisible();
  28 |   });
  29 | 
  30 |   test('Create Product Validation', async ({ page }) => {
  31 |     await page.goto('/dashboard/products/create');
  32 |     
  33 |     // Try to submit empty form
  34 |     await page.click('button[type="submit"]');
  35 |     
  36 |     // Should stay on page due to HTML5 validation or show Laravel errors
  37 |     await expect(page).toHaveURL(/\/dashboard\/products\/create/);
  38 |   });
  39 | 
  40 |   test('View Orders', async ({ page }) => {
  41 |     await page.goto('/dashboard/orders');
  42 |     await expect(page).toHaveTitle(/Pesanan/i);
  43 |   });
  44 | 
  45 |   test('View Staff/Cashiers', async ({ page }) => {
  46 |     await page.goto('/dashboard/staff');
  47 |     await expect(page).toHaveTitle(/Staf|Kasir/i);
  48 |   });
  49 | 
  50 |   test('Export Report PDF', async ({ page }) => {
  51 |     // Navigate to reports if it exists
  52 |     await page.goto('/dashboard/reports').catch(() => {});
  53 |     
  54 |     // Some apps use direct URL for export
  55 |     // Playwright can wait for download
  56 |     const exportBtn = page.locator('a[href*="export?format=pdf"]');
  57 |     if (await exportBtn.isVisible()) {
  58 |       const [download] = await Promise.all([
  59 |         page.waitForEvent('download'),
  60 |         exportBtn.click(),
  61 |       ]);
  62 |       expect(download.suggestedFilename()).toContain('.pdf');
  63 |     }
  64 |   });
  65 | 
  66 | });
  67 | 
```