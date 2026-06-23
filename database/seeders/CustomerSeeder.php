<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CustomerAddress;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Membangun 20 Customer Dummy...');
        $faker = Faker::create('id_ID');

        $customers = [];
        $baliFirstNames = ['Wayan', 'Made', 'Nyoman', 'Ketut', 'Putu', 'Kadek', 'Komang', 'Gede', 'Ida Ayu', 'Anak Agung'];
        
        for ($i = 1; $i <= 20; $i++) {
            $firstName = $faker->randomElement($baliFirstNames);
            $lastName = $faker->lastName;
            $customers[] = User::firstOrCreate(
                ['email' => "customer{$i}@smart-umkm.test"],
                [
                    'name' => "{$firstName} {$lastName}",
                    'password' => Hash::make('password'),
                    'role' => 'customer',
                    'email_verified_at' => now(),
                ]
            );
        }

        $this->command->info('Membuat 10 Alamat Customer...');
        for ($i = 0; $i < 10; $i++) {
            CustomerAddress::create([
                'user_id' => $customers[$i]->id,
                'recipient_name' => $customers[$i]->name,
                'phone' => '0812' . rand(10000000, 99999999),
                'address' => $faker->address,
                'city' => 'Denpasar',
                'province' => 'Bali',
                'district' => 'Denpasar Selatan',
                'postal_code' => '80111',
                'is_default' => true,
            ]);
        }

        $this->command->info('Membuat 50 Cart Items...');
        $products = Product::inRandomOrder()->limit(30)->get();
        if ($products->count() > 0) {
            $cartItemsCreated = 0;
            foreach ($customers as $customer) {
                // Not all customers have carts
                if (rand(1, 10) > 7) continue;

                $cart = Cart::firstOrCreate(['user_id' => $customer->id]);
                
                $itemCount = rand(1, 5);
                for ($j = 0; $j < $itemCount; $j++) {
                    if ($cartItemsCreated >= 50) break 2;
                    
                    $product = $products->random();
                    CartItem::firstOrCreate([
                        'cart_id' => $cart->id,
                        'product_id' => $product->id,
                    ], [
                        'quantity' => rand(1, 3),
                    ]);
                    
                    $cartItemsCreated++;
                }
            }
        }
    }
}
