<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class StaffController extends Controller
{
    /**
     * Display a listing of the staff (cashiers).
     */
    public function index(): View
    {
        $store = auth()->user()->currentStore();
        abort_unless(auth()->user()->isOwner(), 403, 'Hanya Owner yang dapat mengakses halaman ini.');

        $staffs = User::where('store_id', $store->id)
            ->where('role', 'cashier')
            ->orderBy('name')
            ->paginate(10);

        return view('staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new staff.
     */
    public function create(): View
    {
        abort_unless(auth()->user()->isOwner(), 403, 'Hanya Owner yang dapat mengakses halaman ini.');
        
        return view('staff.create');
    }

    /**
     * Store a newly created staff in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $store = auth()->user()->currentStore();
        abort_unless(auth()->user()->isOwner(), 403, 'Hanya Owner yang dapat mengakses halaman ini.');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $staff = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'cashier',
            'store_id' => $store->id,
        ]);

        app(\App\Services\ActivityLogService::class)->log(
            $store->id,
            auth()->id(),
            'create_staff',
            "Mendaftarkan staff kasir baru: {$staff->name}"
        );

        return redirect()->route('staff.index')->with('success', 'Staff kasir berhasil ditambahkan.');
    }

    /**
     * Remove the specified staff from storage.
     */
    public function destroy(User $staff): RedirectResponse
    {
        $store = auth()->user()->currentStore();
        abort_unless(auth()->user()->isOwner(), 403, 'Hanya Owner yang dapat mengakses halaman ini.');
        abort_unless($staff->store_id === $store->id, 403, 'Akses ditolak.');

        $staffName = $staff->name;
        $staff->delete();

        app(\App\Services\ActivityLogService::class)->log(
            $store->id,
            auth()->id(),
            'delete_staff',
            "Menghapus akun staff kasir: {$staffName}"
        );

        return redirect()->route('staff.index')->with('success', 'Staff kasir berhasil dihapus.');
    }
}
