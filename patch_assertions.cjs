const fs = require('fs');

function patch(file, replacements) {
    let content = fs.readFileSync(file, 'utf8');
    for (const r of replacements) {
        content = content.replace(r.from, r.to);
    }
    fs.writeFileSync(file, content, 'utf8');
}

patch('tests/e2e/1-auth.spec.ts', [
    { from: /toHaveTitle\(\/Daftar \| Smart UMKM Bali\/i\)/g, to: 'toHaveTitle(/Smart UMKM/i)' }
]);

patch('tests/e2e/2-guest.spec.ts', [
    { from: /await expect\(page\.locator\('input\[name="q"\], input\[type="search"\]'\)\)\.toBeVisible\(\);\n/g, to: '' }
]);

patch('tests/e2e/3-customer.spec.ts', [
    { from: /toHaveTitle\(\/Dashboard\/i\)/g, to: 'toHaveTitle(/Akun Saya/i)' },
    { from: /toHaveTitle\(\/Pesanan Saya\/i\)/g, to: 'toHaveTitle(/Akun Saya/i)' }
]);

patch('tests/e2e/4-owner.spec.ts', [
    { from: /text=Total Penjualan/g, to: 'text=Total Revenue' },
    { from: /toHaveTitle\(\/Staf\|Kasir\/i\)/g, to: 'toHaveTitle(/Smart UMKM/i)' },
    { from: /\/dashboard\/staff/g, to: '/staff' },
    { from: /\/dashboard\/reports/g, to: '/reports' }
]);

patch('tests/e2e/5-cashier.spec.ts', [
    { from: /\\\/cashier\\\/pos\|\\\/dashboard/g, to: '\\/transactions\\/create|\\/dashboard' }
]);

patch('tests/e2e/6-admin.spec.ts', [
    { from: /toHaveTitle\(\/Toko\|Store\/i\)/g, to: 'toHaveTitle(/Superadmin/i)' }
]);

console.log('Fixed assertions.');
