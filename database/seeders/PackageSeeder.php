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
                "name" => "Paquete Esencial",
                "description" => "Espectáculo aéreo de múltiples efectos con una duración aproximada 40 segundos
detonando en alturas de 50 y 120 mts compuesto por lo siguiente: 
-35 Disparos Bombet de diferentes colores. 
-3 Bombas crisantemo de colores Grande,",
                "price" => 3900,
                "duration" => "40 segundos (aproximadamente)",
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
            ]
        ];

        foreach ($packages as $package) {
            $products = [];
            $equipments = [];
            if (isset($package["products"])) {
                $products = $package["products"];
                unset($package["products"]);
            }
            if (isset($package["equipments"])) {
                $equipments = $package["equipments"];
                unset($package["equipments"]);
            }
            $newPackage = new Package($package);

            foreach ($equipments as $equipment) {
                $newPackage->equipments()->attach($equipment["id"], ['quantity' => $equipment["quantity"]]);
            }

            foreach ($products as $product) {
                $newPackage->materials()->attach($product["id"], ['quantity' => $product["quantity"]]);
            }
            $newPackage->save();
        }
    }
}
