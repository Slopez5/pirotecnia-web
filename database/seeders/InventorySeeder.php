<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inventories = [
            [
                'name' => 'Inventario Polvorin 1',
                'location' => 'Polvorin 1',
            ],
        ];

        Inventory::insert($inventories);
    }
}
