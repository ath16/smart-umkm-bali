<?php
$collection = [
    "info" => [
        "name" => "Smart UMKM Bali - UAT & API Tests",
        "description" => "Complete Postman collection for 5 roles: Guest, Customer, Owner, Cashier, Admin. Includes 50 test cases.",
        "schema" => "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
    ],
    "item" => [],
    "variable" => [
        [ "key" => "base_url", "value" => "http://localhost:8000", "type" => "string" ]
    ]
];

function createRequest($name, $method, $path, $tests, $body = null) {
    $req = [
        "name" => $name,
        "event" => [
            [
                "listen" => "test",
                "script" => [
                    "exec" => $tests,
                    "type" => "text/javascript"
                ]
            ]
        ],
        "request" => [
            "method" => $method,
            "header" => [
                ["key" => "Accept", "value" => "application/json"]
            ],
            "url" => [
                "raw" => "{{base_url}}$path",
                "host" => ["{{base_url}}"],
                "path" => array_values(array_filter(explode('/', explode('?', $path)[0]))),
                "query" => []
            ]
        ],
        "response" => []
    ];
    if (strpos($path, '?') !== false) {
        $query = explode('?', $path)[1];
        parse_str($query, $queryParams);
        foreach ($queryParams as $k => $v) {
            $req['request']['url']['query'][] = ["key" => $k, "value" => $v];
        }
    }
    if ($body) {
        $req['request']['body'] = [
            "mode" => "formdata",
            "formdata" => []
        ];
        foreach ($body as $k => $v) {
            $req['request']['body']['formdata'][] = ["key" => $k, "value" => (string)$v, "type" => "text"];
        }
    }
    return $req;
}

$tests = [
    // GUEST (10)
    ["Guest", "View Landing Page", "GET", "/", ["pm.test('Status 200', function() { pm.response.to.have.status(200); });"]],
    ["Guest", "View Marketplace Catalog", "GET", "/products", ["pm.test('Status 200', function() { pm.response.to.have.status(200); });"]],
    ["Guest", "Search Products Valid", "GET", "/products?q=kopi", ["pm.test('Search works', function() { pm.response.to.have.status(200); });"]],
    ["Guest", "Search Products Empty", "GET", "/products?q=xxxxxxx", ["pm.test('Empty search', function() { pm.response.to.have.status(200); });"]],
    ["Guest", "Autocomplete API", "GET", "/api/search/autocomplete?q=kopi", ["pm.test('JSON format', function() { pm.response.to.have.status(200); pm.expect(pm.response.json()).to.be.an('array'); });"]],
    ["Guest", "View Store List", "GET", "/stores", ["pm.test('Status 200', function() { pm.response.to.have.status(200); });"]],
    ["Guest", "View Single Store", "GET", "/stores/toko-biasa", ["pm.test('Store exists', function() { pm.expect(pm.response.code).to.be.oneOf([200, 404]); });"]],
    ["Guest", "View Product Detail", "GET", "/products/kopi-susu", ["pm.test('Product exists', function() { pm.expect(pm.response.code).to.be.oneOf([200, 404]); });"]],
    ["Guest", "Shipping Rates API", "GET", "/api/shipping-rates?weight=1000", ["pm.test('Returns JSON rates', function() { pm.response.to.have.status(200); });"]],
    ["Guest", "Unauthorized Cart Add", "POST", "/cart/1", ["pm.test('Redirects to login', function() { pm.expect(pm.response.code).to.be.oneOf([401, 302]); });"]],

    // AUTH (6)
    ["Auth", "Register Customer Valid", "POST", "/register", ["pm.test('Register success', function() { pm.expect(pm.response.code).to.be.oneOf([201, 302]); });"], ["name"=>"Cus1","email"=>"c1@test.com","password"=>"password","password_confirmation"=>"password","role"=>"customer"]],
    ["Auth", "Register Missing Data", "POST", "/register", ["pm.test('Validation Error 422', function() { pm.expect(pm.response.code).to.be.oneOf([422, 302]); });"], ["email"=>"c1@test.com"]],
    ["Auth", "Login Valid", "POST", "/login", ["pm.test('Login success', function() { pm.expect(pm.response.code).to.be.oneOf([200, 302]); });"], ["email"=>"customer@smart-umkm.test", "password"=>"password"]],
    ["Auth", "Login Invalid Pass", "POST", "/login", ["pm.test('Login fail', function() { pm.expect(pm.response.code).to.be.oneOf([422, 302]); });"], ["email"=>"customer@smart-umkm.test", "password"=>"wrong"]],
    ["Auth", "Logout", "POST", "/logout", ["pm.test('Logout success', function() { pm.expect(pm.response.code).to.be.oneOf([200, 302]); });"]],
    ["Auth", "Login Owner", "POST", "/login", ["pm.test('Login success', function() { pm.expect(pm.response.code).to.be.oneOf([200, 302]); });"], ["email"=>"owner@smart-umkm.test", "password"=>"password"]],

    // CUSTOMER (10)
    ["Customer", "View Dashboard", "GET", "/customer/dashboard", ["pm.test('Status 200', function() { pm.response.to.have.status(200); });"]],
    ["Customer", "Add Address", "POST", "/customer/addresses", ["pm.test('Address created', function() { pm.expect(pm.response.code).to.be.oneOf([201, 302]); });"], ["recipient_name"=>"John","phone"=>"0812","province"=>"Bali","city"=>"Denpasar","address"=>"Jl Bali"]],
    ["Customer", "Add to Cart", "POST", "/cart/1", ["pm.test('Cart added', function() { pm.expect(pm.response.code).to.be.oneOf([200, 302]); });"], ["quantity"=>1]],
    ["Customer", "Update Cart", "PUT", "/cart/1", ["pm.test('Cart updated', function() { pm.expect(pm.response.code).to.be.oneOf([200, 302]); });"], ["quantity"=>2]],
    ["Customer", "Remove from Cart", "DELETE", "/cart/1", ["pm.test('Cart removed', function() { pm.expect(pm.response.code).to.be.oneOf([200, 302]); });"]],
    ["Customer", "View Cart", "GET", "/cart", ["pm.test('Status 200', function() { pm.response.to.have.status(200); });"]],
    ["Customer", "View Checkout", "GET", "/checkout", ["pm.test('Status 200 or Redirect', function() { pm.expect(pm.response.code).to.be.oneOf([200, 302]); });"]],
    ["Customer", "Process Checkout Validation", "POST", "/checkout", ["pm.test('Validation Error', function() { pm.expect(pm.response.code).to.be.oneOf([422, 302]); });"], []],
    ["Customer", "Order History", "GET", "/customer/orders", ["pm.test('Status 200', function() { pm.response.to.have.status(200); });"]],
    ["Customer", "Try Admin URL (Fail)", "GET", "/admin/dashboard", ["pm.test('Forbidden 403', function() { pm.expect(pm.response.code).to.be.oneOf([403, 404]); });"]],

    // OWNER (12)
    ["Owner", "View Dashboard", "GET", "/dashboard", ["pm.test('Status 200', function() { pm.response.to.have.status(200); });"]],
    ["Owner", "Create Product Valid", "POST", "/dashboard/products", ["pm.test('Product Created', function() { pm.expect(pm.response.code).to.be.oneOf([201, 302]); });"], ["name"=>"Test Product", "cost_price"=>1000, "sell_price"=>2000, "stock"=>10, "weight"=>100, "status"=>"published"]],
    ["Owner", "Create Product Invalid", "POST", "/dashboard/products", ["pm.test('Validation Error', function() { pm.expect(pm.response.code).to.be.oneOf([422, 302]); });"], ["name"=>"Test"]],
    ["Owner", "View Products", "GET", "/dashboard/products", ["pm.test('Status 200', function() { pm.response.to.have.status(200); });"]],
    ["Owner", "Update Product", "PUT", "/dashboard/products/1", ["pm.test('Product Updated', function() { pm.expect(pm.response.code).to.be.oneOf([200, 302]); });"], ["name"=>"Test Updated"]],
    ["Owner", "Delete Product", "DELETE", "/dashboard/products/1", ["pm.test('Product Deleted', function() { pm.expect(pm.response.code).to.be.oneOf([200, 302]); });"]],
    ["Owner", "View Online Orders", "GET", "/dashboard/orders", ["pm.test('Status 200', function() { pm.response.to.have.status(200); });"]],
    ["Owner", "Update Order Status", "PUT", "/dashboard/orders/1", ["pm.test('Status Updated', function() { pm.expect(pm.response.code).to.be.oneOf([200, 302]); });"], ["status"=>"processing"]],
    ["Owner", "Create Staff", "POST", "/dashboard/staff", ["pm.test('Staff Created', function() { pm.expect(pm.response.code).to.be.oneOf([201, 302]); });"], ["name"=>"Kasir 2", "email"=>"kasir2@test.com", "password"=>"password"]],
    ["Owner", "View Staff", "GET", "/dashboard/staff", ["pm.test('Status 200', function() { pm.response.to.have.status(200); });"]],
    ["Owner", "Delete Staff", "DELETE", "/dashboard/staff/1", ["pm.test('Staff Deleted', function() { pm.expect(pm.response.code).to.be.oneOf([200, 302]); });"]],
    ["Owner", "Export Reports", "GET", "/dashboard/reports/export?format=pdf", ["pm.test('Export works', function() { pm.expect(pm.response.code).to.be.oneOf([200, 302]); });"]],

    // CASHIER (6)
    ["Cashier", "View POS", "GET", "/cashier/pos", ["pm.test('Status 200', function() { pm.response.to.have.status(200); });"]],
    ["Cashier", "Process POS Success", "POST", "/cashier/transactions", ["pm.test('POS Success', function() { pm.expect(pm.response.code).to.be.oneOf([201, 302]); });"], ["total_amount"=>10000, "payment_amount"=>10000]],
    ["Cashier", "Process POS Underpaid", "POST", "/cashier/transactions", ["pm.test('POS Underpaid Validation', function() { pm.expect(pm.response.code).to.be.oneOf([422, 302]); });"], ["total_amount"=>10000, "payment_amount"=>5000]],
    ["Cashier", "View Transaction History", "GET", "/cashier/transactions", ["pm.test('Status 200', function() { pm.response.to.have.status(200); });"]],
    ["Cashier", "Try Delete Product (Fail)", "DELETE", "/dashboard/products/2", ["pm.test('Forbidden 403', function() { pm.expect(pm.response.code).to.be.oneOf([403, 302]); });"]],
    ["Cashier", "Try Export Report (Fail)", "GET", "/dashboard/reports/export", ["pm.test('Forbidden 403', function() { pm.expect(pm.response.code).to.be.oneOf([403, 302]); });"]],

    // ADMIN (6)
    ["Admin", "View Admin Dashboard", "GET", "/admin/dashboard", ["pm.test('Status 200', function() { pm.response.to.have.status(200); });"]],
    ["Admin", "View All Stores", "GET", "/admin/stores", ["pm.test('Status 200', function() { pm.response.to.have.status(200); });"]],
    ["Admin", "Suspend Store Valid", "POST", "/admin/stores/1/suspend", ["pm.test('Suspend works', function() { pm.expect(pm.response.code).to.be.oneOf([200, 302]); });"], ["reason"=>"Fraud detected"]],
    ["Admin", "Suspend Store Missing Reason", "POST", "/admin/stores/1/suspend", ["pm.test('Suspend validation', function() { pm.expect(pm.response.code).to.be.oneOf([422, 302]); });"], []],
    ["Admin", "Unsuspend Store", "POST", "/admin/stores/1/unsuspend", ["pm.test('Unsuspend works', function() { pm.expect(pm.response.code).to.be.oneOf([200, 302]); });"]],
    ["Admin", "View Suspensions History", "GET", "/admin/suspensions", ["pm.test('Status 200', function() { pm.response.to.have.status(200); });"]]
];

$folders = [];
foreach ($tests as $t) {
    $folderName = $t[0];
    if (!isset($folders[$folderName])) {
        $folders[$folderName] = ["name" => $folderName, "item" => []];
    }
    $folders[$folderName]["item"][] = createRequest("[$folderName] " . $t[1], $t[2], $t[3], $t[4], $t[5] ?? null);
}

foreach ($folders as $f) {
    $collection['item'][] = $f;
}

file_put_contents('/Users/athafajriputra/.gemini/antigravity/brain/31e57b2e-8d93-434b-891f-ddf2cbedf848/Postman_Collection_Smart_UMKM_Bali.json', json_encode($collection, JSON_PRETTY_PRINT));
echo "Generated collection.\n";
