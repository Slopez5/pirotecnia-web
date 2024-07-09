<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //add name, description and price
        $products = [
            [
                'name' => 'bombas 3"',
                'description' => 'bombas 3"',
                'price' => 0
            ],
            [
                'name' => 'bombas 4"',
                'description' => 'bombas 4"',
                'price' => 0
            ],
            [
                'name' => 'bombas de 5"',
                'description' => 'bombas de 5"',
                'price' => 0
            ],
            [
                'name' => 'bombas 6"',
                'description' => 'bombas 6"',
                'price' => 0
            ],
            [
                'name' => 'bombas 8"',
                'description' => 'bombas 8"',
                'price' => 0
            ],
            [
                'name' => 'cake sublime',
                'description' => 'cake sublime',
                'price' => 0
            ],
            [
                'name' => 'cake esplendor',
                'description' => 'cake esplendor',
                'price' => 0
            ],
            [
                'name' => 'cake alien',
                'description' => 'cake alien',
                'price' => 0
            ],
            [
                'name' => 'cake fresa',
                'description' => 'cake fresa',
                'price' => 0
            ],
            [
                'name' => 'cake wow',
                'description' => 'cake wow',
                'price' => 0
            ],
            [
                'name' => 'cruz del sur azul',
                'description' => 'cruz del sur azul',
                'price' => 0
            ],
            [
                'name' => 'cruz del sur rojo',
                'description' => 'cruz del sur rojo',
                'price' => 0
            ],
            [
                'name' => 'cruz del sur lluvia',
                'description' => 'cruz del sur lluvia',
                'price' => 0
            ],
            [
                'name' => 'cake bravío',
                'description' => 'cake bravío',
                'price' => 0
            ],
            [
                'name' => 'cake indomable',
                'description' => 'cake indomable',
                'price' => 0
            ],
            [
                'name' => 'cake maximo',
                'description' => 'cake maximo',
                'price' => 0
            ],
            [
                'name' => 'cake perrón',
                'description' => 'cake perrón',
                'price' => 0
            ],
            [
                'name' => 'cake Titan',
                'description' => 'cake Titan',
                'price' => 0
            ],
            [
                'name' => 'cake smokey azul',
                'description' => 'cake smokey azul',
                'price' => 0
            ],
            [
                'name' => 'cake smokey rojo',
                'description' => 'cake smokey rojo',
                'price' => 0
            ],
            [
                'name' => 'smokey púrpura',
                'description' => 'smokey púrpura',
                'price' => 0
            ],
            [
                'name' => 'cake incógnito azul',
                'description' => 'cake incógnito azul',
                'price' => 0
            ],
            [
                'name' => 'cake incógnito rosa',
                'description' => 'cake incógnito rosa',
                'price' => 0
            ],
            [
                'name' => 'cake kamuro plata',
                'description' => 'cake kamuro plata',
                'price' => 0
            ],
            [
                'name' => 'candil 1.5x8',
                'description' => 'candil 1.5x8',
                'price' => 0
            ],
            [
                'name' => 'candil .8x10',
                'description' => 'candil .8x10',
                'price' => 0
            ]
        ];

        Product::insert($products);
    }
}
