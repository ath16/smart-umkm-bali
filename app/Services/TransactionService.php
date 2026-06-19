<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransactionService
{
    /**
     * Process a new transaction.
     *
     * @param  int    $storeId
     * @param  int    $userId
     * @param  array  $items       [['product_id' => int, 'quantity' => int], ...]
     * @param  float  $paymentAmount
     * @param  string|null $notes
     * @return Transaction
     *
     * @throws ValidationException
     */
    public function processTransaction(
        int $storeId,
        int $userId,
        array $items,
        float $paymentAmount,
        ?string $notes = null
    ): Transaction {
        return DB::transaction(function () use ($storeId, $userId, $items, $paymentAmount, $notes) {
            // 1. Validate and collect product data with stock locking
            $lineItems = $this->resolveAndValidateItems($storeId, $items);

            // 2. Calculate totals
            $totalAmount = 0;
            $totalCost = 0;

            foreach ($lineItems as &$item) {
                $item['subtotal'] = $item['sell_price'] * $item['quantity'];
                $item['cost_subtotal'] = $item['cost_price'] * $item['quantity'];
                $totalAmount += $item['subtotal'];
                $totalCost += $item['cost_subtotal'];
            }
            unset($item);

            // 3. Validate payment
            if ($paymentAmount < $totalAmount) {
                throw ValidationException::withMessages([
                    'payment_amount' => ["Pembayaran (Rp" . number_format($paymentAmount, 0, ',', '.') . ") kurang dari total (Rp" . number_format($totalAmount, 0, ',', '.') . ")."],
                ]);
            }

            $changeAmount = $paymentAmount - $totalAmount;

            // 4. Create transaction record
            $transaction = Transaction::create([
                'store_id' => $storeId,
                'user_id' => $userId,
                'invoice_number' => Transaction::generateInvoiceNumber(),
                'total_amount' => $totalAmount,
                'total_cost' => $totalCost,
                'payment_amount' => $paymentAmount,
                'change_amount' => $changeAmount,
                'notes' => $notes,
            ]);

            // 5. Create transaction details and reduce stock
            foreach ($lineItems as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['product_name'],
                    'quantity' => $item['quantity'],
                    'cost_price' => $item['cost_price'],
                    'sell_price' => $item['sell_price'],
                    'subtotal' => $item['subtotal'],
                ]);

                // Reduce stock
                Product::where('id', $item['product_id'])
                    ->decrement('stock', $item['quantity']);
            }

            // 6. Reload with relations
            return $transaction->load('details', 'user');
        });
    }

    /**
     * Resolve product data and validate stock availability.
     * Uses pessimistic locking to prevent race conditions.
     *
     * @param  int   $storeId
     * @param  array $items
     * @return array
     *
     * @throws ValidationException
     */
    private function resolveAndValidateItems(int $storeId, array $items): array
    {
        $lineItems = [];
        $errors = [];

        // Merge duplicate product entries
        $merged = [];
        foreach ($items as $item) {
            $pid = $item['product_id'];
            if (isset($merged[$pid])) {
                $merged[$pid]['quantity'] += $item['quantity'];
            } else {
                $merged[$pid] = $item;
            }
        }

        foreach ($merged as $item) {
            $product = Product::where('id', $item['product_id'])
                ->where('store_id', $storeId)
                ->lockForUpdate()
                ->first();

            if (!$product) {
                $errors[] = "Produk dengan ID {$item['product_id']} tidak ditemukan.";
                continue;
            }

            if ($product->stock < $item['quantity']) {
                $errors[] = "Stok \"{$product->name}\" tidak cukup. Tersedia: {$product->stock}, diminta: {$item['quantity']}.";
                continue;
            }

            if ($item['quantity'] <= 0) {
                $errors[] = "Jumlah untuk \"{$product->name}\" harus lebih dari 0.";
                continue;
            }

            $lineItems[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'cost_price' => $product->cost_price,
                'sell_price' => $product->sell_price,
                'quantity' => $item['quantity'],
            ];
        }

        if (!empty($errors)) {
            throw ValidationException::withMessages([
                'items' => $errors,
            ]);
        }

        return $lineItems;
    }
}
