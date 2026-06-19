<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use App\Models\CustomerAddress;
use App\Models\PaymentTransaction;
use App\Services\OrderCheckoutService;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display checkout page.
     */
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::with(['items.product.store'])->firstOrCreate(['user_id' => $user->id]);

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        // Fix: use 'user_id' (matches the CustomerAddress model), not 'customer_id'
        $address = CustomerAddress::where('user_id', $user->id)->where('is_default', true)->first();
        if (!$address) {
            $address = CustomerAddress::where('user_id', $user->id)->first();
        }

        $groupedItems = $cart->items->groupBy(function($item) {
            return $item->product->store->id;
        });

        $totalShippingFee = 0; // Will be calculated dynamically on frontend
        
        $subtotalAmount = 0;
        $totalWeight = 0;
        foreach ($cart->items as $item) {
            $subtotalAmount += $item->quantity * $item->product->sell_price;
            $totalWeight += $item->quantity * ($item->product->weight ?? 1000);
        }

        $totalAmount = $subtotalAmount + $totalShippingFee;

        return view('checkout.index', compact('cart', 'groupedItems', 'address', 'subtotalAmount', 'totalShippingFee', 'totalAmount', 'totalWeight'));
    }

    /**
     * Process checkout.
     */
    public function process(Request $request, OrderCheckoutService $checkoutService)
    {
        $request->validate([
            'address_id' => 'required|exists:customer_addresses,id',
            'payment_method' => 'required|string',
            'courier_name' => 'required|string',
            'courier_service' => 'required|string',
        ]);

        $user = Auth::user();

        // Security: Verify the address belongs to the authenticated user
        $addressBelongsToUser = CustomerAddress::where('id', $request->address_id)
            ->where('user_id', $user->id)
            ->exists();

        if (!$addressBelongsToUser) {
            abort(403, 'Alamat tidak valid.');
        }

        $cart = Cart::with(['items.product.store'])->where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        try {
            $paymentTx = $checkoutService->processCheckout(
                $user, 
                $cart, 
                $request->address_id, 
                $request->payment_method, 
                $request->courier_name,
                $request->courier_service,
                $request->notes
            );

            return redirect()->route('checkout.success', ['reference' => $paymentTx->reference_number]);

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Show success page.
     */
    public function success(Request $request)
    {
        $reference = $request->query('reference');
        
        if (!$reference) {
            return redirect()->route('landing');
        }

        $paymentTx = PaymentTransaction::with('orders.store')->where('reference_number', $reference)->firstOrFail();

        // Security: Ensure the payment belongs to the authenticated user
        abort_unless($paymentTx->user_id === Auth::id(), 403, 'Akses ditolak.');

        return view('checkout.success', compact('paymentTx'));
    }
}
