<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Store;
use App\Models\Product;
use App\Models\User;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Membangun 50 Transaksi POS...');
        $stores = Store::all();
        
        if ($stores->isEmpty()) {
            $this->command->error('Stores tidak ditemukan.');
            return;
        }

        for ($i = 1; $i <= 50; $i++) {
            $store = $stores->random();
            $cashier = User::where('store_id', $store->id)->where('role', 'cashier')->first() ?? User::where('store_id', $store->id)->where('role', 'owner')->first();
            
            if (!$cashier) continue;

            $date = now()->subDays(rand(0, 30))->subHours(rand(0, 23));
            $products = Product::where('store_id', $store->id)->inRandomOrder()->limit(rand(1, 4))->get();
            if ($products->isEmpty()) continue;

            $totalAmount = 0;
            $totalCost = 0;
            $details = [];

            foreach ($products as $product) {
                $qty = rand(1, 5);
                $subtotal = $product->sell_price * $qty;
                $costSubtotal = $product->cost_price * $qty;

                $totalAmount += $subtotal;
                $totalCost += $costSubtotal;

                $details[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $qty,
                    'cost_price' => $product->cost_price,
                    'sell_price' => $product->sell_price,
                    'subtotal' => $subtotal,
                ];
            }

            $invoiceNumber = 'POS-' . $date->format('Ymd') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT);

            $txId = DB::table('transactions')->insertGetId([
                'store_id' => $store->id,
                'user_id' => $cashier->id,
                'invoice_number' => $invoiceNumber,
                'total_amount' => $totalAmount,
                'total_cost' => $totalCost,
                'payment_amount' => $totalAmount,
                'change_amount' => 0,
                'notes' => 'Direct Walk-in Customer',
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            foreach ($details as $detail) {
                DB::table('transaction_details')->insert([
                    'transaction_id' => $txId,
                    'product_id' => $detail['product_id'],
                    'product_name' => $detail['product_name'],
                    'quantity' => $detail['quantity'],
                    'cost_price' => $detail['cost_price'],
                    'sell_price' => $detail['sell_price'],
                    'subtotal' => $detail['subtotal'],
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
