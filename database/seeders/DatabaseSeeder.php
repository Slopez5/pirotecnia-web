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
            EquipmentSeeder::class,
            EventTypeSeeder::class,
            ClientTypeSeeder::class,
            ProductRoleSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            InventorySeeder::class,
            PackageSeeder::class,
        ]);
    }
}
