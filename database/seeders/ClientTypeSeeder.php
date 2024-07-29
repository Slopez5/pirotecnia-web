<?php

namespace Database\Seeders;

use App\Models\ClientType;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $clientTypes = [
            [
                'name' => 'Mayorista',
                'description' => 'Mayorista',
            ],
            [
                'name' => 'Minorista',
                'description' => 'Minorista',
            ],
            [
                'name' => 'semiMayorista',
                'description' => 'semiMayorista',
            ],
        ];

        foreach ($clientTypes as $clientType) {
            ClientType::create($clientType);
        }
    }
}
