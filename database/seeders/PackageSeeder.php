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

        $packages = [
            [
                "id" => 1,
                "name" => "Papel Picado",
                "description" => "Papel picado de colores",
                "price" => 6500,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 7,
                        "name" => "Blaster CO2 lanza papel picado con papel adicional",
                        "quantity" => 20
                    ]
                ]
            ],
            [
                "id" => 2,
                "name" => "Fiesta",
                "description" => "Paquete Fiesta",
                "price" => 4500,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 37,
                        "name" => "Dispato chicos diferentes efectos y colores",
                        "quantity" => 50
                    ],
                    [
                        "id" => 22,
                        "name" => "Bombas medianas efecto cracker",
                        "quantity" => 8
                    ],
                    [
                        "id" => 35,
                        "name" => "Crisantemo grande de colores",
                        "quantity" => 4
                    ],
                    [
                        "id" => 36,
                        "name" => "Crisantemo Mega de colores",
                        "quantity" => 2
                    ]
                ]
            ],
            [
                "id" => 3,
                "name" => "Titan",
                "description" => "Paquete Titan",
                "price" => 3500,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "equipaments" => [
                    [
                        "id" => 1,
                        "name" => "Base para cake",
                        "quantity" => 1
                    ],
                    [
                        "id" => 2,
                        "name" => "Base para candil",
                        "quantity" => 1
                    ],
                    [
                        "id" => 11,
                        "name" => "kit Módulo 12Ch",
                        "quantity" => 1
                    ],
                    [
                        "id" => 3,
                        "name" => "cerillo 1.5",
                        "quantity" => 12
                    ],
                    [
                        "id" => 4,
                        "name" => "cincho plástico",
                        "quantity" => 6
                    ],
                    [
                        "id" => 5,
                        "name" => "cincho matraca",
                        "quantity" => 2
                    ],
                    [
                        "id" => 12,
                        "name" => "tubo 4''",
                        "quantity" => 5
                    ],
                    [
                        "id" => 13,
                        "name" => "tubo 5''",
                        "quantity" => 2
                    ],
                    [
                        "id" => 14,
                        "name" => "tubo 6''",
                        "quantity" => 1
                    ],
                    [
                        "id" => 9,
                        "name" => "encendedor",
                        "quantity" => 1
                    ],
                    [
                        "id" => 8,
                        "name" => "cutter",
                        "quantity" => 1
                    ],
                    [
                        "id" => 7,
                        "name" => "cinta plástico ancha",
                        "quantity" => 1
                    ],
                    [
                        "id" => 6,
                        "name" => "cinta papel",
                        "quantity" => 1
                    ],
                    [
                        "id" => 10,
                        "name" => "extintor PQS",
                        "quantity" => 1
                    ]
                ],
                "products" => [
                    [
                        "id" => 41,
                        "name" => "Disparos de Diferentes colores con estrobo",
                        "quantity" => 16
                    ],
                    [
                        "id" => 23,
                        "name" => "Bombet disparos chicos colores",
                        "quantity" => 20
                    ],
                    [
                        "id" => 2,
                        "name" => "Bazuca grande (diferentes colores)",
                        "quantity" => 5
                    ],
                    [
                        "id" => 3,
                        "name" => "Bazuca Mega (diferentes colores)",
                        "quantity" => 2
                    ],
                    [
                        "id" => 1,
                        "name" => "Bazuca especial (diferentes colores)",
                        "quantity" => 1
                    ]
                ]
            ],
            [
                "id" => 4,
                "name" => "Básico",
                "description" => "Paquete Básico",
                "price" => 6800,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "equipaments" => [
                    [
                        "id" => 1,
                        "name" => "Base para cake",
                        "quantity" => 1
                    ],
                    [
                        "id" => 2,
                        "name" => "Base para candil",
                        "quantity" => 1
                    ],
                    [
                        "id" => 11,
                        "name" => "kit Módulo 12Ch",
                        "quantity" => 1
                    ],
                    [
                        "id" => 3,
                        "name" => "cerillo 1.5",
                        "quantity" => 12
                    ],
                    [
                        "id" => 4,
                        "name" => "cincho plástico",
                        "quantity" => 6
                    ],
                    [
                        "id" => 5,
                        "name" => "cincho matraca",
                        "quantity" => 2
                    ],
                    [
                        "id" => 12,
                        "name" => "tubo 4''",
                        "quantity" => 4
                    ],
                    [
                        "id" => 13,
                        "name" => "Tubo 5''",
                        "quantity" => 3
                    ],
                    [
                        "id" => 9,
                        "name" => "encendedor",
                        "quantity" => 1
                    ],
                    [
                        "id" => 8,
                        "name" => "cutter",
                        "quantity" => 1
                    ],
                    [
                        "id" => 7,
                        "name" => "cinta plástico ancha",
                        "quantity" => 1
                    ],
                    [
                        "id" => 6,
                        "name" => "cinta papel",
                        "quantity" => 1
                    ],
                    [
                        "id" => 10,
                        "name" => "extintor PQS",
                        "quantity" => 1
                    ]
                ],
                "products" => [
                    [
                        "id" => 28,
                        "name" => "Cake disparos diferentes efectos y colores",
                        "quantity" => 100
                    ],
                    [
                        "id" => 22,
                        "name" => "Bombas medianas efecto cracker",
                        "quantity" => 16
                    ],
                    [
                        "id" => 18,
                        "name" => "Bombas crisantemo de colores Grande",
                        "quantity" => 4
                    ],
                    [
                        "id" => 19,
                        "name" => "Bombas crisantemo de colores Mega",
                        "quantity" => 3
                    ]
                ]
            ],
            [
                "id" => 5,
                "name" => "Grandioso",
                "description" => "Paquete Grandioso",
                "price" => 8100,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "equipaments" => [
                    [
                        "id" => 1,
                        "name" => "Base para cake",
                        "quantity" => 1
                    ],
                    [
                        "id" => 2,
                        "name" => "Base para candil",
                        "quantity" => 1
                    ],
                    [
                        "id" => 11,
                        "name" => "kit Módulo 12Ch",
                        "quantity" => 1
                    ],
                    [
                        "id" => 3,
                        "name" => "cerillo 1.5",
                        "quantity" => 12
                    ],
                    [
                        "id" => 4,
                        "name" => "cincho plástico",
                        "quantity" => 6
                    ],
                    [
                        "id" => 5,
                        "name" => "cincho matraca",
                        "quantity" => 2
                    ],
                    [
                        "id" => 12,
                        "name" => "tubo 4''",
                        "quantity" => 5
                    ],
                    [
                        "id" => 13,
                        "name" => "Tubo 5''",
                        "quantity" => 3
                    ],
                    [
                        "id" => 9,
                        "name" => "encendedor",
                        "quantity" => 1
                    ],
                    [
                        "id" => 8,
                        "name" => "cutter",
                        "quantity" => 1
                    ],
                    [
                        "id" => 7,
                        "name" => "cinta plástico ancha",
                        "quantity" => 1
                    ],
                    [
                        "id" => 6,
                        "name" => "cinta papel",
                        "quantity" => 1
                    ],
                    [
                        "id" => 10,
                        "name" => "extintor PQS",
                        "quantity" => 1
                    ]
                ],
                "products" => [
                    [
                        "id" => 28,
                        "name" => "Cake disparos diferentes efectos y colores",
                        "quantity" => 100
                    ],
                    [
                        "id" => 14,
                        "name" => "Bombas chicas efecto craker y color",
                        "quantity" => 24
                    ],
                    [
                        "id" => 39,
                        "name" => "Disapros abanico con craker",
                        "quantity" => 50
                    ],
                    [
                        "id" => 18,
                        "name" => "Bombas crisantemo de colores Grande",
                        "quantity" => 5
                    ],
                    [
                        "id" => 19,
                        "name" => "Bombas crisantemo de colores Mega",
                        "quantity" => 3
                    ]
                ]
            ],
            [
                "id" => 6,
                "name" => "Elegancia",
                "description" => "Paquete Elegancia",
                "price" => 9200,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 28,
                        "name" => "Cake disparos diferentes efectos y colores",
                        "quantity" => 60
                    ],
                    [
                        "id" => 24,
                        "name" => "Cake abanico diferentes efectos y colores",
                        "quantity" => 60
                    ],
                    [
                        "id" => 13,
                        "name" => "Bombas candil efecto chicos",
                        "quantity" => 24
                    ],
                    [
                        "id" => 22,
                        "name" => "Bombas medianas efecto cracker",
                        "quantity" => 16
                    ],
                    [
                        "id" => 18,
                        "name" => "Bombas crisantemo de colores Grande",
                        "quantity" => 6
                    ],
                    [
                        "id" => 19,
                        "name" => "Bombas crisantemo de colores Mega",
                        "quantity" => 4
                    ]
                ]
            ],
            [
                "id" => 7,
                "name" => "Espectacular",
                "description" => "Paquete Espectacular",
                "price" => 10500,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 26,
                        "name" => "Cake abanico disparos diferentes efectos y colore",
                        "quantity" => 50
                    ],
                    [
                        "id" => 28,
                        "name" => "Cake disparos diferentes efectos y colores",
                        "quantity" => 100
                    ],
                    [
                        "id" => 30,
                        "name" => "Candil disparos bombet chicos",
                        "quantity" => 40
                    ],
                    [
                        "id" => 22,
                        "name" => "Bombas medianas efecto cracker",
                        "quantity" => 16
                    ],
                    [
                        "id" => 18,
                        "name" => "Bombas crisantemo de colores Grande",
                        "quantity" => 8
                    ],
                    [
                        "id" => 19,
                        "name" => "Bombas crisantemo de colores Mega",
                        "quantity" => 4
                    ]
                ]
            ],
            [
                "id" => 8,
                "name" => "Genial",
                "description" => "Paquete Genial",
                "price" => 13500,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "equipaments" => [
                    [
                        "id" => 1,
                        "name" => "Base para cake",
                        "quantity" => 1
                    ],
                    [
                        "id" => 2,
                        "name" => "Base para candil",
                        "quantity" => 1
                    ],
                    [
                        "id" => 11,
                        "name" => "kit Módulo 12Ch",
                        "quantity" => 1
                    ],
                    [
                        "id" => 3,
                        "name" => "cerillo 1.5",
                        "quantity" => 25
                    ],
                    [
                        "id" => 4,
                        "name" => "cincho plástico",
                        "quantity" => 12
                    ],
                    [
                        "id" => 5,
                        "name" => "cincho matraca",
                        "quantity" => 4
                    ],
                    [
                        "id" => 12,
                        "name" => "tubo 4''",
                        "quantity" => 10
                    ],
                    [
                        "id" => 13,
                        "name" => "tubo 5''",
                        "quantity" => 6
                    ],
                    [
                        "id" => 14,
                        "name" => "tubo 6''",
                        "quantity" => 3
                    ],
                    [
                        "id" => 9,
                        "name" => "encendedor",
                        "quantity" => 1
                    ],
                    [
                        "id" => 8,
                        "name" => "cutter",
                        "quantity" => 1
                    ],
                    [
                        "id" => 7,
                        "name" => "cinta plástico ancha",
                        "quantity" => 1
                    ],
                    [
                        "id" => 6,
                        "name" => "cinta papel",
                        "quantity" => 1
                    ],
                    [
                        "id" => 10,
                        "name" => "extintor PQS",
                        "quantity" => 1
                    ]
                ],
                "products" => [
                    [
                        "id" => 25,
                        "name" => "Cake abanico disparos diferentes colores y efectos",
                        "quantity" => 100
                    ],
                    [
                        "id" => 27,
                        "name" => "Cake disparos diferentes colores y efecto",
                        "quantity" => 120
                    ],
                    [
                        "id" => 40,
                        "name" => "Disparos bombet colores",
                        "quantity" => 30
                    ],
                    [
                        "id" => 22,
                        "name" => "Bombas medianas efecto cracker",
                        "quantity" => 16
                    ],
                    [
                        "id" => 18,
                        "name" => "Bombas crisantemo de colores Grande",
                        "quantity" => 8
                    ],
                    [
                        "id" => 19,
                        "name" => "Bombas crisantemo de colores Mega",
                        "quantity" => 6
                    ],
                    [
                        "id" => 17,
                        "name" => "Bombas crisantemo de colores Especial",
                        "quantity" => 3
                    ]
                ]
            ],
            [
                "id" => 9,
                "name" => "Asombroso",
                "description" => "Paquete Asombroso",
                "price" => 15400,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 29,
                        "name" => "Cake especial abanico disparos medianos",
                        "quantity" => 150
                    ],
                    [
                        "id" => 30,
                        "name" => "Candil disparos bombet chicos",
                        "quantity" => 120
                    ],
                    [
                        "id" => 42,
                        "name" => "Monotiros tricolor",
                        "quantity" => 50
                    ],
                    [
                        "id" => 22,
                        "name" => "Bombas medianas efecto cracker",
                        "quantity" => 32
                    ],
                    [
                        "id" => 18,
                        "name" => "Bombas crisantemo de colores Grande",
                        "quantity" => 10
                    ],
                    [
                        "id" => 19,
                        "name" => "Bombas crisantemo de colores Mega",
                        "quantity" => 6
                    ],
                    [
                        "id" => 17,
                        "name" => "Bombas crisantemo de colores Especial",
                        "quantity" => 4
                    ]
                ]
            ],
            [
                "id" => 10,
                "name" => "Torito",
                "description" => "Paquete Torito",
                "price" => 2800,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 45,
                        "name" => "Torito pirotecnico con o sin buscapies",
                        "quantity" => 1
                    ],
                    [
                        "id" => 34,
                        "name" => "Coheton de luz o trueno",
                        "quantity" => 12
                    ],
                    [
                        "id" => 11,
                        "name" => "Bombas crisantemo de colores Grande",
                        "quantity" => 4
                    ]
                ]
            ],
            [
                "id" => 11,
                "name" => "Castillo",
                "description" => "Paquete Castillo",
                "price" => 23500,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 31,
                        "name" => "Castillo basico con o sin buscapies",
                        "quantity" => 1
                    ],
                    [
                        "id" => 44,
                        "name" => "Torito pirotecnico",
                        "quantity" => 1
                    ],
                    [
                        "id" => 12,
                        "name" => "Bombas crisantemo de colores Mega",
                        "quantity" => 6
                    ]
                ]
            ],
            [
                "id" => 12,
                "name" => "Piromusical",
                "description" => "Variedad de disapros detonados al ritmo de la musica. (Bombas, minas, cometas, crossete, candelas, bombets, strobo, craker, etc.) De 3 a 5 puntos de disparo. El costo se estima a partir de la duracion a elegir y ronda aproximadamente $17,000.00 por minuto",
                "price" => 17000,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => 13,
                "name" => "Maquina lanza papel",
                "description" => "Maquina lanza papel de colores",
                "price" => 2900,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 8,
                        "name" => "Blaster CO2 lanza papel picado metalico",
                        "quantity" => 1
                    ],
                    [
                        "id" => 32,
                        "name" => "Chisperos de luz fria 3 metros x 30 segundos",
                        "quantity" => 2
                    ]
                ]
            ],
            [
                "id" => 14,
                "name" => "Maquina lanza papel",
                "description" => "Maquina lanza papel de colores",
                "price" => 3300,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 8,
                        "name" => "Blaster CO2 lanza papel picado metalico",
                        "quantity" => 1
                    ],
                    [
                        "id" => 32,
                        "name" => "Chisperos de luz fria 3 metros x 30 segundos",
                        "quantity" => 4
                    ]
                ]
            ],
            [
                "id" => 15,
                "name" => "Maquina lanza papel",
                "description" => "Maquina lanza papel de colores",
                "price" => 4000,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 8,
                        "name" => "Blaster CO2 lanza papel picado metalico",
                        "quantity" => 1
                    ],
                    [
                        "id" => 32,
                        "name" => "Chisperos de luz fria 3 metros x 30 segundos",
                        "quantity" => 6
                    ]
                ]
            ],
            [
                "id" => 16,
                "name" => "Maquina lanza papel",
                "description" => "Maquina lanza papel de colores",
                "price" => 4400,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 8,
                        "name" => "Blaster CO2 lanza papel picado metalico",
                        "quantity" => 1
                    ],
                    [
                        "id" => 32,
                        "name" => "Chisperos de luz fria 3 metros x 30 segundos",
                        "quantity" => 8
                    ]
                ]
            ],
            [
                "id" => 17,
                "name" => "Chisperos",
                "description" => "Chisperos de colores",
                "price" => 1500,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 32,
                        "name" => "Chisperos de luz fria 3 metros x 30 segundos",
                        "quantity" => 4
                    ]
                ]
            ],
            [
                "id" => 18,
                "name" => "Chisperos",
                "description" => "Chisperos de colores",
                "price" => 1800,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 32,
                        "name" => "Chisperos de luz fria 3 metros x 30 segundos",
                        "quantity" => 6
                    ]
                ]
            ],
            [
                "id" => 19,
                "name" => "Chisperos",
                "description" => "Chisperos de colores",
                "price" => 2300,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 32,
                        "name" => "Chisperos de luz fria 3 metros x 30 segundos",
                        "quantity" => 8
                    ]
                ]
            ],
            [
                "id" => 20,
                "name" => "Revelación Chisperos",
                "description" => "Revelación de chisperos de colores",
                "price" => 1800,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 32,
                        "name" => "Chisperos de luz fria 3 metros x 30 segundos",
                        "quantity" => 4
                    ],
                    [
                        "id" => 5,
                        "name" => "Bengalas de humo azul o rosa",
                        "quantity" => 2
                    ]
                ]
            ],
            [
                "id" => 21,
                "name" => "Revelación chicos",
                "description" => "Revelación chicos",
                "price" => 2150,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 32,
                        "name" => "Chisperos de luz fria 3 metros x 30 segundos",
                        "quantity" => 2
                    ],
                    [
                        "id" => 5,
                        "name" => "Bengalas de humo azul o rosa",
                        "quantity" => 2
                    ],
                    [
                        "id" => 9,
                        "name" => "Bombas crisantemo azul o rosa",
                        "quantity" => 3
                    ]
                ]
            ],
            [
                "id" => 22,
                "name" => "Revelación Bombas",
                "description" => "Revelación Bombas",
                "price" => 2450,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 38,
                        "name" => "Disaperos aereos con efecto craker y color azul o rosa",
                        "quantity" => 16
                    ],
                    [
                        "id" => 9,
                        "name" => "Bombas crisantemo azul o rosa Grande",
                        "quantity" => 4
                    ]
                ]
            ],
            [
                "id" => 23,
                "name" => "Revelación Mediano",
                "description" => "Revelación Mediano",
                "price" => 2900,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 5,
                        "name" => "Bengalas de humo azul o rosa",
                        "quantity" => 2
                    ],
                    [
                        "id" => 6,
                        "name" => "Blaster CO2 lanza papel picado azul o rosa",
                        "quantity" => 1
                    ],
                    [
                        "id" => 9,
                        "name" => "Bomba crisantemo azul o rosa",
                        "quantity" => 1
                    ]
                ]
            ],
            [
                "id" => 24,
                "name" => "Revelación Blaster",
                "description" => "Revelación Blaster",
                "price" => 3300,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 4,
                        "name" => "Bengalas de azul o rosa",
                        "quantity" => 2
                    ],
                    [
                        "id" => 33,
                        "name" => "Chisperos de luz fria 3 mts x 30 segundos",
                        "quantity" => 3
                    ],
                    [
                        "id" => 6,
                        "name" => "Blaster CO2 lanza papel picado azul o rosa",
                        "quantity" => 1
                    ]
                ]
            ],
            [
                "id" => 25,
                "name" => "Revelación Grande",
                "description" => "Revelación Grande",
                "price" => 6800,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 6,
                        "name" => "Blaster CO2 lanza papel picado azul o rosa",
                        "quantity" => 1
                    ],
                    [
                        "id" => 43,
                        "name" => "Puntos de disapro de humo azul o rosa con craker y diamantina",
                        "quantity" => 3
                    ],
                    [
                        "id" => 33,
                        "name" => "Chisperos de luz fria 3 mts x 30 segundos",
                        "quantity" => 2
                    ]
                ]
            ],
            [
                "id" => 26,
                "name" => "Revelación Grande",
                "description" => "Revelación Grande",
                "price" => 4700,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null,
                "products" => [
                    [
                        "id" => 6,
                        "name" => "Blaster CO2 lanza papel picado azul o rosa",
                        "quantity" => 1
                    ],
                    [
                        "id" => 43,
                        "name" => "Puntos de disapro de humo azul o rosa con craker y diamantina",
                        "quantity" => 3
                    ]
                ]
            ],
            [
                "id" => 27,
                "name" => "Revelación Piromusical",
                "description" => "Espectaculo audiovisual con pirotecnia azul o rosa detonada al ritmo de la musica. Duracion aproximada de 2 minutos, al firmar contrato se elige la cancion y se presenta el diseño para detonacion por el cliente",
                "price" => 12500,
                "duration" => null,
                "video_url" => null,
                "created_at" => null,
                "updated_at" => null
            ]
        ];

        foreach ($packages as $package) {
            $products = [];
            $equipaments = [];
            if (isset($package["products"])) {
                $products = $package["products"];
                unset($package["products"]);
            }
            if (isset($package["equipaments"])) {
                $equipaments = $package["equipaments"];
                unset($package["equipaments"]);
            }
            $newPackage = new Package($package);

            foreach ($equipaments as $equipament) {
                $newPackage->equipaments()->attach($equipament["id"], ['quantity' => $equipament["quantity"]]);
            }

            foreach ($products as $product) {
                $newPackage->productGroups()->attach($product["id"], ['quantity' => $product["quantity"]]);
            }
            $newPackage->save();
        }
    }
}
