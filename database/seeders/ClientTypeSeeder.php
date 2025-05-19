<?php

namespace Database\Seeders;

use App\Models\ClientType;
use Illuminate\Database\Seeder;

class ClientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // "WholesalePrice" => (double)$productExcel[3] * 1.7,
        // "WholesalePriceCredit" => (double)$productExcel[3] * 2.1,
        // "MediumWholesalePrice" => (double)$productExcel[3] * 2.3,
        // "PublicPrice" => (double)$productExcel[3] * 4
        $clientTypes = [
            [
                'name' => 'Mayorista',
                'description' => 'Precio de venta al por mayor',
                'percentage_price' => 1.7,
            ],
            [
                'name' => 'Mayorista Crédito',
                'description' => 'Precio de venta al por mayor a crédito',
                'percentage_price' => 2.1,
            ],
            [
                'name' => 'Medio Mayorista',
                'description' => 'Precio de venta al medio mayorista',
                'percentage_price' => 2.3,
            ],
            [
                'name' => 'Público',
                'description' => 'Precio de venta al público',
                'percentage_price' => 4,
            ],
        ];

        foreach ($clientTypes as $clientType) {
            ClientType::create($clientType);
        }
    }
}
