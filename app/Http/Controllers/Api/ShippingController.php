<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ShippingService;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function getRates(Request $request, ShippingService $shippingService)
    {
        $request->validate([
            'weight' => 'required|integer|min:1',
        ]);

        $rates = $shippingService->getRates($request->weight);

        return response()->json([
            'success' => true,
            'data' => $rates,
        ]);
    }
}
