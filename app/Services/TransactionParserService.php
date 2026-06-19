<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Str;

class TransactionParserService
{
    /**
     * Parse text input into structured transaction items.
     * Expected format: "Kopi Bali 2, Roti Coklat 1" or "Kopi Bali" (defaults to 1 qty)
     *
     * @param string $text
     * @param int $storeId
     * @return array
     */
    public function parseText(string $text, int $storeId): array
    {
        if (empty(trim($text))) {
            return ['error' => 'Teks transaksi tidak boleh kosong.'];
        }

        $items = explode(',', $text);
        $parsedItems = [];
        $errors = [];
        $totalAmount = 0;

        foreach ($items as $itemStr) {
            $itemStr = trim($itemStr);
            if (empty($itemStr)) continue;

            // Regex to match product name and quantity at the end.
            // Example: "Kopi Bali 2" -> match[1] = "Kopi Bali", match[2] = "2"
            if (preg_match('/^(.*?)(\s+(\d+))?$/', $itemStr, $matches)) {
                $productNameQuery = trim($matches[1]);
                $quantity = isset($matches[3]) && is_numeric($matches[3]) ? (int) $matches[3] : 1;

                if (empty($productNameQuery)) continue;

                // Search for product in the specific store
                // We use simple LIKE matching. A robust NLP search is out of scope.
                $product = Product::where('store_id', $storeId)
                    ->where('name', 'LIKE', '%' . $productNameQuery . '%')
                    ->first();

                if (!$product) {
                    $errors[] = "Produk \"{$productNameQuery}\" tidak ditemukan di toko ini.";
                    continue;
                }

                if ($product->stock < $quantity) {
                    $errors[] = "Stok untuk \"{$product->name}\" tidak mencukupi. Tersedia: {$product->stock}, Diminta: {$quantity}.";
                    continue;
                }

                $subtotal = $product->sell_price * $quantity;
                $totalAmount += $subtotal;

                // Check if product is already in parsedItems
                $found = false;
                foreach ($parsedItems as &$pItem) {
                    if ($pItem['product_id'] == $product->id) {
                        $pItem['quantity'] += $quantity;
                        $pItem['subtotal'] += $subtotal;
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    $parsedItems[] = [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'sell_price' => $product->sell_price,
                        'cost_price' => $product->cost_price,
                        'quantity' => $quantity,
                        'subtotal' => $subtotal,
                    ];
                }
            }
        }

        if (empty($parsedItems) && empty($errors)) {
            return ['error' => 'Format teks tidak valid.'];
        }

        return [
            'items' => $parsedItems,
            'errors' => $errors,
            'total_amount' => $totalAmount,
        ];
    }
}
