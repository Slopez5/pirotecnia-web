<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                "name" => "Sergio Omar Lopez Ceballos",
                "email" => "sergio0695@gmail.com",
                "phone" => "9611234567",
                "password" => bcrypt("123456"),
                "role_id" => 1,
            ],
            [
                "name" => "Rafael Alejandro Lopez Ceballos",
                "email" => "ackteck1993@gmail.com",
                "phone" => "9611234567",
                "password" => bcrypt("123456"),
                "role_id" => 2,
            ]
        ];

        User::insert($users);
    }
}
