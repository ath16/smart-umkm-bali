<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\StoreCategory;
use App\Models\StoreSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StoreController extends Controller
{
    /**
     * Show the form for creating a new store.
     */
    public function create(): View
    {
        $user = auth()->user();
        abort_if($user->isCashier() || $user->currentStore(), 403, 'Anda sudah terdaftar di sebuah toko.');

        return view('stores.create');
    }

    /**
     * Store a newly created store in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();
        abort_if($user->isCashier() || $user->currentStore(), 403, 'Anda sudah terdaftar di sebuah toko.');

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'contact' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $store = Store::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'category' => $request->category,
            'contact' => $request->contact,
            'address' => $request->address,
            'description' => $request->description,
        ]);

        StoreSetting::create([
            'store_id' => $store->id
        ]);

        $user->update([
            'role' => 'owner',
            'store_id' => $store->id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Toko berhasil dibuat! Selamat datang di Dasbor Owner.');
    }

    /**
     * Show the form for editing the store profile.
     */
    public function edit(): View
    {
        $store = auth()->user()->currentStore();
        $store->load('setting');
        abort_unless(auth()->user()->isOwner(), 403, 'Hanya Owner yang dapat mengelola profil toko.');

        $categories = StoreCategory::all();

        return view('stores.edit', compact('store', 'categories'));
    }

    /**
     * Update the specified store in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $store = auth()->user()->currentStore();
        abort_unless(auth()->user()->isOwner(), 403, 'Hanya Owner yang dapat mengelola profil toko.');

        $request->validate([
            'name' => 'required|string|max:255',
            'store_category_id' => 'nullable|exists:store_categories,id',
            'contact' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|mimetypes:image/jpeg,image/png,image/webp|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|mimetypes:image/jpeg,image/png,image/webp|max:4096',
            'operational_hours' => 'nullable|string',
            'social_links' => 'nullable|string',
        ]);

        $store->update([
            'name' => $request->name,
            'store_category_id' => $request->store_category_id,
            'contact' => $request->contact,
            'address' => $request->address,
            'description' => $request->description,
        ]);

        $setting = $store->setting ?? new StoreSetting(['store_id' => $store->id]);

        if ($request->hasFile('logo')) {
            if ($setting->logo_path) {
                Storage::disk('public')->delete($setting->logo_path);
            }
            $setting->logo_path = $request->file('logo')->store('stores/logos', 'public');
        }

        if ($request->hasFile('banner')) {
            if ($setting->banner_path) {
                Storage::disk('public')->delete($setting->banner_path);
            }
            $setting->banner_path = $request->file('banner')->store('stores/banners', 'public');
        }

        if ($request->filled('operational_hours')) {
            // For MVP, parse simple JSON string from textarea or similar
            $setting->operational_hours = json_decode($request->operational_hours, true);
        }

        if ($request->filled('social_links')) {
            $setting->social_links = json_decode($request->social_links, true);
        }

        $setting->save();

        return redirect()->route('stores.edit')->with('success', 'Profil toko berhasil diperbarui.');
    }
}
