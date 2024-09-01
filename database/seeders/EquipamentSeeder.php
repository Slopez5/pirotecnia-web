<?php

namespace Database\Seeders;

use App\Models\equipment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class equipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $equipments = [
            [
                'name' => 'Base para cakes',
                'description' => 'Base para cakes',
                'unit' => 'pz'
            ],
            [
                'name' => 'Base para candil',
                'description' => 'Base para candil',
                'unit' => 'pz'
            ],
            [
                'name' => 'Cerillos',
                'description' => 'Cerillos',
                'unit' => 'pz'
            ],
            [
                'name' => 'Chincho plástico',
                'description' => 'Chincho plástico',
                'unit' => 'pz'
            ],
            [
                'name' => 'Cincho matraca',
                'description' => 'Cincho matraca',
                'unit' => 'pz'
            ],
            [
                'name' => 'Cinta papel',
                'description' => 'Cinta papel',
                'unit' => 'pz'
            ],
            [
                'name' => 'Cinta plástico ancha',
                'description' => 'Cinta plástico ancha',
                'unit' => 'pz'
            ],
            [
                'name' => 'Cutter',
                'description' => 'Cutter',
                'unit' => 'pz'
            ],
            [
                'name' => 'Encendedor',
                'description' => 'Encendedor',
                'unit' => 'pz'
            ],
            [
                'name' => 'Extintor PQS',
                'description' => 'Extintor PQS',
                'unit' => 'pz'
            ],
            [
                'name' => 'Kit Módulo 12 Ch',
                'description' => 'Kit Módulo 12 Ch',
                'unit' => 'pz'
            ],
            [
                'name' => 'Tubo 4"',
                'description' => 'Tubo 4"',
                'unit' => 'pz'
            ],
            [
                'name' => 'Tubo 5"',
                'description' => 'Tubo 5"',
                'unit' => 'pz'
            ],
            [
                'name' => 'Tubo 6"',
                'description' => 'Tubo 6"',
                'unit' => 'pz'
            ],
            [
                'name' => 'Tubo 8"',
                'description' => 'Tubo 8"',
                'unit' => 'pz'
            ],
        ];

        foreach ($equipments as $equipment) {
            equipment::create($equipment);
        }
    }
}
