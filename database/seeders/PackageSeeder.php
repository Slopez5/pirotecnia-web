<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // add packages and products in packages
        $packages = [
            [
                "name" => "Papel Picado",
                "description" => "Papel picado de colores",
                "price" => 6500.00,
            ],
            [
                "name" => "Fiesta",
                "description" => "Paquete Fiesta",
                "price" => 4500.00
            ],
            [
                "name" => "Titan",
                "description" => "Paquete Titan",
                "price" => 3500.00,

            ],
            [
                "name" => "Básico",
                "description" => "Paquete Básico",
                "price" => 6800.00,
            ],
            [
                "name" => "Grandioso",
                "description" => "Paquete Grandioso",
                "price" => 8100.00,
            ],
            [
                "name" => "Elegancia",
                "description" => "Paquete Elegancia",
                "price" => 9200.00,
            ],
            [
                "name" => "Espectacular",
                "description" => "Paquete Espectacular",
                "price" => 10500.00,
            ],
            [
                "name" => "Genial",
                "description" => "Paquete Genial",
                "price" => 13500.00,
            ],
            [
                "name" => "Asombroso",
                "description" => "Paquete Asombroso",
                "price" => 15400.00,
            ],
            [
                "name" => "Torito",
                "description" => "Paquete Torito",
                "price" => 2800.00,
            ],
            [
                "name" => "Castillo",
                "description" => "Paquete Castillo",
                "price" => 23500.00,
            ],
            [
                "name" => "Piromusical",
                "description" => "Variedad de disapros detonados al ritmo de la musica. (Bombas, minas, cometas, crossete, candelas, bombets, strobo, craker, etc.) De 3 a 5 puntos de disparo. El costo se estima a partir de la duracion a elegir y ronda aproximadamente $17,000.00 por minuto",
                "price" => 17000.00
            ],
            [
                "name" => "Maquina lanza papel",
                "description" => "Maquina lanza papel de colores",
                "price" => 2900.00,
            ],
            [
                "name" => "Maquina lanza papel",
                "description" => "Maquina lanza papel de colores",
                "price" => 3300.00,
            ],
            [
                "name" => "Maquina lanza papel",
                "description" => "Maquina lanza papel de colores",
                "price" => 4000.00,
            ],
            [
                "name" => "Maquina lanza papel",
                "description" => "Maquina lanza papel de colores",
                "price" => 4400.00,
            ],
            [
                "name" => "Chisperos",
                "description" => "Chisperos de colores",
                "price" => 1500.00,
            ],
            [
                "name" => "Chisperos",
                "description" => "Chisperos de colores",
                "price" => 1800.00,
            ],
            [
                "name" => "Chisperos",
                "description" => "Chisperos de colores",
                "price" => 2300.00,
            ],
            [
                "name" => "Revelación Chisperos",
                "description" => "Revelación de chisperos de colores",
                "price" => 1800.00,
            ],
            [
                "name" => "Revelación chicos",
                "description" => "Revelación chicos",
                "price" => 2150.00,
            ],
            [
                "name" => "Revelación Bombas",
                "description" => "Revelación Bombas",
                "price" => 2450.00,
            ],
            [
                "name" => "Revelación Mediano",
                "description" => "Revelación Mediano",
                "price" => 2900.00,
            ],
            [
                "name" => "Revelación Blaster",
                "description" => "Revelación Blaster",
                "price" => 3300.00,
            ],
            [
                "name" => "Revelación Grande",
                "description" => "Revelación Grande",
                "price" => 6800.00,
            ],
            [
                "name" => "Revelación Grande",
                "description" => "Revelación Grande",
                "price" => 4700.00,
            ],
            [
                "name" => "Revelación Piromusical",
                "description" => "Espectaculo audiovisual con pirotecnia azul o rosa detonada al ritmo de la musica. Duracion aproximada de 2 minutos, al firmar contrato se elige la cancion y se presenta el diseño para detonacion por el cliente",
                "price" => 12500.00,
            ]
        ];

        Package::insert($packages);
    }
}
