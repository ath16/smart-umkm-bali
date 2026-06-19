<?php

namespace App\Http\Controllers;

use App\Models\CustomerAddress;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = auth()->user()->customerAddresses()->get();

        return view('customer.address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'address' => 'required|string',
            'is_default' => 'boolean',
        ]);

        $validated['is_default'] = $request->has('is_default');
        
        // If this is the first address, force it to be default
        if (auth()->user()->customerAddresses()->count() === 0) {
            $validated['is_default'] = true;
        }

        if ($validated['is_default']) {
            auth()->user()->customerAddresses()->update(['is_default' => false]);
        }

        auth()->user()->customerAddresses()->create($validated);

        return redirect()->route('customer.address.index')->with('success', 'Alamat berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerAddress $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        return view('customer.address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerAddress $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'address' => 'required|string',
            'is_default' => 'boolean',
        ]);

        $validated['is_default'] = $request->has('is_default');

        if ($validated['is_default'] && !$address->is_default) {
            auth()->user()->customerAddresses()->update(['is_default' => false]);
        }

        // Prevent un-defaulting if it's the only address
        if (!$validated['is_default'] && auth()->user()->customerAddresses()->count() === 1) {
            $validated['is_default'] = true;
        }

        $address->update($validated);

        return redirect()->route('customer.address.index')->with('success', 'Alamat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerAddress $address)
    {
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        $wasDefault = $address->is_default;
        
        $address->delete();

        // If the deleted address was default, make the first remaining address default
        if ($wasDefault) {
            $firstAddress = auth()->user()->customerAddresses()->first();
            if ($firstAddress) {
                $firstAddress->update(['is_default' => true]);
            }
        }

        return redirect()->route('customer.address.index')->with('success', 'Alamat berhasil dihapus.');
    }
}
