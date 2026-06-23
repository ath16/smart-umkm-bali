<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Store;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Membangun 30 Pesanan Marketplace...');
        $faker = Faker::create('id_ID');

        $customers = User::where('role', 'customer')->get();
        $stores = Store::all();
        
        if ($customers->isEmpty() || $stores->isEmpty()) {
            $this->command->error('Customers atau Stores tidak ditemukan. Harap jalankan CustomerSeeder & StoreSeeder terlebih dahulu.');
            return;
        }

        // 10 Pending, 10 Processing (Paid), 10 Completed
        $statuses = array_merge(
            array_fill(0, 10, 'pending'),
            array_fill(0, 10, 'processing'),
            array_fill(0, 10, 'completed')
        );

        shuffle($statuses);

        for ($i = 0; $i < 30; $i++) {
            $store = $stores->random();
            $customer = $customers->random();
            $status = $statuses[$i];
            $date = now()->subDays(rand(0, 30))->subHours(rand(0, 23));

            $products = Product::where('store_id', $store->id)->inRandomOrder()->limit(rand(1, 3))->get();
            if ($products->isEmpty()) continue;

            $totalAmount = 0;
            $details = [];

            foreach ($products as $product) {
                $qty = rand(1, 3);
                $subtotal = $product->sell_price * $qty;
                $totalAmount += $subtotal;

                $details[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $qty,
                    'price' => $product->sell_price,
                    'subtotal' => $subtotal,
                ];
            }

            $shippingFee = rand(1, 5) * 10000;
            $grandTotal = $totalAmount + $shippingFee;
            $invoiceNumber = 'INV-' . $date->format('Ymd') . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT);

            $order = Order::create([
                'store_id' => $store->id,
                'user_id' => $customer->id,
                'invoice_number' => $invoiceNumber,
                'total_amount' => $grandTotal,
                'status' => $status,
                'payment_method' => 'bank_transfer',
                'shipping_courier' => 'JNT',
                'shipping_fee' => $shippingFee,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            foreach ($details as $detail) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $detail['product_id'],
                    'product_name' => $detail['product_name'],
                    'quantity' => $detail['quantity'],
                    'price' => $detail['price'],
                    'subtotal' => $detail['subtotal'],
                ]);
            }
        }
    }
}
