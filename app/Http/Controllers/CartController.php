<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the cart items.
     */
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Load items with product and store relationships
        $items = $cart->items()->with(['product.store', 'product.images'])->get();

        // Group items by store for the view
        $groupedItems = $items->groupBy(function($item) {
            return $item->product->store->id;
        });

        return view('cart.index', compact('groupedItems', 'cart'));
    }

    /**
     * Store a newly created cart item.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $product = Product::findOrFail($request->product_id);

        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($newQuantity > $product->stock) {
                return back()->with('error', 'Stok tidak mencukupi untuk jumlah ini.');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Update the specified cart item.
     */
    public function update(Request $request, CartItem $cartItem)
    {
        // Ensure the cart item belongs to the user
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($request->quantity > $cartItem->product->stock) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Stok tidak mencukupi.'], 400);
            }
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $cartItem->update(['quantity' => $request->quantity]);

        if ($request->wantsJson()) {
            $cart = Cart::with('items.product')->find($cartItem->cart_id);
            $totalAmount = $cart->items->sum(function($item) {
                return $item->quantity * $item->product->sell_price;
            });
            $itemSubtotal = $cartItem->quantity * $cartItem->product->sell_price;
            $totalItems = $cart->items->sum('quantity');

            return response()->json([
                'success' => true,
                'itemSubtotal' => number_format($itemSubtotal, 0, ',', '.'),
                'totalAmount' => number_format($totalAmount, 0, ',', '.'),
                'totalItems' => $totalItems,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Keranjang diperbarui.');
    }

    /**
     * Remove the specified cart item.
     */
    public function destroy(CartItem $cartItem)
    {
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cartId = $cartItem->cart_id;
        $cartItem->delete();

        if (request()->wantsJson()) {
            $cart = Cart::with('items.product')->find($cartId);
            $totalAmount = $cart->items->sum(function($item) {
                return $item->quantity * $item->product->sell_price;
            });
            $totalItems = $cart->items->sum('quantity');

            return response()->json([
                'success' => true,
                'totalAmount' => number_format($totalAmount, 0, ',', '.'),
                'totalItems' => $totalItems,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }
}
