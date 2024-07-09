<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = [
            ['name' => 'root', 'description' => 'Super Admin'],
            ['name' => 'admin', 'description' => 'Admin'],
            ['name' => 'user', 'description' => 'User'],
        ];

        Role::insert($roles);
    }
}
