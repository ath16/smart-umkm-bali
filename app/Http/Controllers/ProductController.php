<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Get the current store for the authenticated user.
     */
    private function getStoreId(): int
    {
        $store = auth()->user()->currentStore();
        abort_unless($store, 403, 'Anda belum memiliki usaha.');

        return $store->id;
    }

    /**
     * Display a listing of products.
     */
    public function index(Request $request): View
    {
        $storeId = $this->getStoreId();

        if ($request->filled('search')) {
            $query = Product::search($request->query('search'))->query(fn ($q) => $q->where('store_id', $storeId));
        } else {
            $query = Product::where('store_id', $storeId);
        }

        $products = $query->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('products.index', [
            'products' => $products,
            'search' => $request->query('search'),
        ]);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $this->authorize('create', Product::class);

        return view('products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $this->authorize('create', Product::class);

        $storeId = $this->getStoreId();

        $product = Product::create([
            'store_id' => $storeId,
            'name' => $request->name,
            'cost_price' => $request->cost_price,
            'sell_price' => $request->sell_price,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'min_stock' => $request->min_stock,
            'is_published' => $request->has('is_published'),
            'is_featured' => $request->has('is_featured'),
        ]);

        app(\App\Services\ActivityLogService::class)->log(
            $storeId,
            auth()->id(),
            'create_product',
            "Menambahkan produk baru: {$product->name}"
        );

        return redirect()
            ->route('dashboard.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        $this->authorize('update', $product);

        return view('products.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $this->authorize('update', $product);

        $product->update([
            'name' => $request->name,
            'cost_price' => $request->cost_price,
            'sell_price' => $request->sell_price,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'min_stock' => $request->min_stock,
            'is_published' => $request->has('is_published'),
            'is_featured' => $request->has('is_featured'),
        ]);

        app(\App\Services\ActivityLogService::class)->log(
            $product->store_id,
            auth()->id(),
            'edit_product',
            "Memperbarui produk: {$product->name}"
        );

        return redirect()
            ->route('dashboard.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified product from storage (soft delete).
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('delete', $product);

        $productName = $product->name;
        $storeId = $product->store_id;

        $product->delete();

        app(\App\Services\ActivityLogService::class)->log(
            $storeId,
            auth()->id(),
            'delete_product',
            "Menghapus produk: {$productName}"
        );

        return redirect()
            ->route('dashboard.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
