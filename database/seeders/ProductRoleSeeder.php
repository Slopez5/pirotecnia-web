<?php

namespace Database\Seeders;

use App\Models\ProductRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $productRoles = [
            [
                "name" => "Productos"
            ],
            [
                "name" => "Materiales"
            ],
            [
                "name" => "Productos Paquete"
            ],
        ];

        ProductRole::insert($productRoles);
    }
}
