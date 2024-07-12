<?php

namespace Database\Seeders;

use App\Models\Purchase;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ProductRoleSeeder::class,
            ProductSeeder::class,
            EquipamentSeeder::class,
            PackageSeeder::class,
            MenuSeeder::class,
            InventorySeeder::class,
            PurchaseSeeder::class,
            
        ]);
    }
}
