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
        // Package Seeder

        $packages = [
            [
                "name" => "Paquete Titan",
                "description" => "Espectáculo Pirotecnico aéreo compuesto por múltiples disparos de diferentes calibres alcanzando alturas que van desde los 45 metros hasta 150 metros, con una duración aproximada de 2:30 minutos confirmado por lo siguiente: \n-16 Disparos Diferentes colores con estrobo\n-20 Disparos Bombet chicos colores \n-5 Bomba crisantemo colores Grande  \n-2 Bomba crisantemo colores Mega \n-1 Bomba crisntemo de colores Especial",
                "price" => 5800,
                "duration" => "2:40",
                "video_url" => null,
                "experience_level_id" => null,
                "created_at" => "2024-08-05 02:28:54",
                "updated_at" => "2024-08-05 02:28:54"
            ],
            [
                "name" => "Paquete Basico",
                "description" => "Espectáculo aéreo de múltiples disparos en diferentes calibres alcanzando alturas desde 45 mts hasta 150 metros con una duración aproximada de 3:00 minutos \n100 disparos con diferentes  efectos de colores y craker \n16 bombas medianas con efecto craker \n4 bombas crisantemos de colores grande \n3  bombas crisantemos de colores mega.",
                "price" => 7200,
                "duration" => "3",
                "video_url" => null,
                "experience_level_id" => null,
                "created_at" => "2024-08-05 03:22:21",
                "updated_at" => "2024-08-05 03:22:21"
            ],
            [
                "name" => "Paquete Esencial",
                "description" => "Espectáculo aéreo de múltiples efectos compuesto por detonaciones de diferentes calibres con alturas de 45 y 100, con una duración aproximada de 40 segundos compuesto por lo siguiente :\n-35 Bombas mini con efecto cracker y estrobo \n-3 Bombas crisantemo de colores Grande ",
                "price" => 3900,
                "duration" => "40 segundos",
                "video_url" => null,
                "experience_level_id" => null,
                "created_at" => "2024-08-06 01:27:42",
                "updated_at" => "2024-08-06 01:27:53"
            ],
            [
                "name" => "Paquete Fiesta",
                "description" => "Espectáculo Pirotecnico aéreo compuesto por múltiples disparos de diferentes calibres alcanzando alturas que van desde los 45 metros hasta 125 metros, con una duración aproximada de 2:30 minutos conformado por lo siguiente:\n-50 Disparos chicos de diferentes efectos y colores \n-8 Bombas medianas con efecto cracker \n-4 Bombas crisantemo de colores grande \n_2 Bombas crisantemo de colores Mega",
                "price" => 5200,
                "duration" => "2:30",
                "video_url" => null,
                "experience_level_id" => null,
                "created_at" => "2024-08-06 01:39:07",
                "updated_at" => "2024-08-06 01:40:55"
            ],
            [
                "name" => "Paquete Grandioso",
                "description" => "Espectáculo Pirotecnico aéreo compuesto por múltiples disparos de diferentes calibres alcanzando alturas que van desde los 45 metros hasta 125 metros, con una duración aproximada de 3 minutos conformado por lo siguiente:\n-100 Disparos chicos de diferentes efectos y colores \n-24 Bombas Mini con cracker y color\n-50 Disparos en abanico con efecto cracker \n-5 Bombas crisantemo de colores Grande\n-3 Bombas crisantemo de colores Mega",
                "price" => 8100,
                "duration" => "3 minutos ",
                "video_url" => null,
                "experience_level_id" => null,
                "created_at" => "2024-08-06 01:46:07",
                "updated_at" => "2024-08-06 01:46:07"
            ],
            [
                "name" => "Paquete Elegancia",
                "description" => "Espectáculo Pirotecnico aéreo compuesto por múltiples disparos de diferentes calibres alcanzando alturas que van desde los 45 metros hasta 125 metros, con una duración aproximada de 3minutos conformado por lo siguiente:\n-120 Disparos chicos de diferentes efectos y colores \n-30 Bombas Mini de colores \n-16 Bombas medianas con efecto cracker \n-6 Bombas crisantemo de colores Grande \n-4 Bombas crisantemo de colores Mega ",
                "price" => 10100,
                "duration" => "3 minutos ",
                "video_url" => null,
                "experience_level_id" => null,
                "created_at" => "2024-08-06 01:54:38",
                "updated_at" => "2024-08-06 01:54:38"
            ],
            [
                "name" => "Paquete Genial",
                "description" => "Espectáculo Pirotecnico aéreo compuesto por múltiples disparos de diferentes calibres alcanzando alturas que van desde los 45 metros hasta 150 metros, con una duración aproximada de 4 minutos conformado por lo siguiente:\n-100 Disparos en abanico con diferentes efectos y colores \n-120 Disparos rectos con diferentes colores \n-30 Disparos Bombet de colores \n-16 Bombas medianas con efecto cracker\n-10 Bombas crisantemo de colores Grande \n-6 Bombas crisantemo de colores Mega\n-3 Bombas crisantemo de colores Especial",
                "price" => 13500,
                "duration" => "4 minutos",
                "video_url" => null,
                "experience_level_id" => null,
                "created_at" => "2024-08-06 02:03:10",
                "updated_at" => "2024-08-06 02:03:10"
            ],
            [
                "name" => "4 Chisperos",
                "description" => "4 Chisperos de \"Luz Fria\" de 3 metros de altura por 30 segundos de duración",
                "price" => 1650,
                "duration" => "30 Segundos",
                "video_url" => null,
                "experience_level_id" => null,
                "created_at" => "2024-08-06 02:26:53",
                "updated_at" => "2024-08-06 02:26:53"
            ],
            [
                "name" => "6 Chisperos",
                "description" => "6 Chisperos de \"Luz Fria\" sin humo ni mal olor con 3 metros de altura por 30 segundos de Duración",
                "price" => 1950,
                "duration" => "30 segundos",
                "video_url" => null,
                "experience_level_id" => null,
                "created_at" => "2024-08-06 02:28:59",
                "updated_at" => "2024-08-06 02:28:59"
            ],
            [
                "name" => "8 Chisperos de \"Luz Fria\"",
                "description" => "8 Chisperos de \"Luz Fria\" sin humo ni mal olor con 3 metros de altura por 30 segundos de duración.\n(Los chisperos pueden dividirse para detonarse 4 en una ocasión y 4 en otra)",
                "price" => 2500,
                "duration" => "30 segundos",
                "video_url" => null,
                "experience_level_id" => null,
                "created_at" => "2024-08-06 02:32:04",
                "updated_at" => "2024-08-06 02:32:04"
            ],
            [
                "name" => "Maquina Lanza Papel picado plateado",
                "description" => "-2 Chisperos de \"Luz Fria\" sin humo ni mal olor con 3 metros de altura y 30 segundos de duración\n-Lluvia  con 1 kg de Confeti o papel picado metálico para efectuar un disparo de aproximadamente 1 minuto o varios disparos cortos ",
                "price" => 3100,
                "duration" => "30 Segundos",
                "video_url" => null,
                "experience_level_id" => null,
                "created_at" => "2024-08-06 02:34:57",
                "updated_at" => "2024-08-06 02:34:57"
            ],
            [
                "name" => "Papel Picado Mariposa y 4 Chisperos",
                "description" => "-4 chisperos de \"Luz Fria\" sin humo ni mal olor con 3 metros de altura y 30 segundos de duración\n-Lluvia de papel picado en forma de mariposa para efectuar un disparo de aproximadamente un minuto o varios disparos cortos",
                "price" => 4500,
                "duration" => "30 segundos",
                "video_url" => null,
                "experience_level_id" => null,
                "created_at" => "2024-08-06 02:40:19",
                "updated_at" => "2024-08-06 02:40:19"
            ]

        ];

        foreach ($packages as $package) {
            $newPackage = new Package($package);
            $newPackage->save();
        }
    }
}
