<?php

namespace App\Services;

class ShippingService
{
    /**
     * Get available shipping methods and rates.
     * In a real application, this would call RajaOngkir or Biteship API.
     * For development, we return mocked data based on weight.
     *
     * @param int $weight Weight in grams
     * @param string $origin Origin city/address
     * @param string $destination Destination city/address
     * @return array
     */
    public function getRates(int $weight = 1000, string $origin = '', string $destination = ''): array
    {
        // Base rate per kg (1000 grams)
        $weightInKg = ceil($weight / 1000) ?: 1;

        return [
            [
                'courier' => 'JNE',
                'service' => 'REG',
                'description' => 'Layanan Reguler',
                'cost' => 15000 * $weightInKg,
                'etd' => '2-3 Hari',
            ],
            [
                'courier' => 'JNE',
                'service' => 'YES',
                'description' => 'Yakin Esok Sampai',
                'cost' => 25000 * $weightInKg,
                'etd' => '1 Hari',
            ],
            [
                'courier' => 'SiCepat',
                'service' => 'Biasa',
                'description' => 'SiCepat Reguler',
                'cost' => 14000 * $weightInKg,
                'etd' => '2-3 Hari',
            ],
            [
                'courier' => 'Gojek',
                'service' => 'Instant',
                'description' => 'Instant Courier',
                'cost' => 45000, // Fixed price for local instant delivery
                'etd' => 'Hari ini',
            ]
        ];
    }
}
