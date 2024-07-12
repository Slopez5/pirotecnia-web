<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Purchase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $purchases = [
            [
                "user_id" => 1,
                "date" => "2024-07-01",
                "products" => [
                    [
                        "product_id" => 1,
                        "quantity" => 80,
                        "price" => 0
                    ],
                    [
                        "product_id" => 2,
                        "quantity" => 200,
                        "price" => 0
                    ],
                    [
                        "product_id" => 3,
                        "quantity" => 200,
                        "price" => 0
                    ],
                    [
                        "product_id" => 4,
                        "quantity" => 200,
                        "price" => 0
                    ],
                    [
                        "product_id" => 5,
                        "quantity" => 40,
                        "price" => 0
                    ],
                    [
                        "product_id" => 6,
                        "quantity" => 8,
                        "price" => 0
                    ],
                    [
                        "product_id" => 7,
                        "quantity" => 8,
                        "price" => 0
                    ],
                    [
                        "product_id" => 8,
                        "quantity" => 8,
                        "price" => 0
                    ],
                    [
                        "product_id" => 9,
                        "quantity" => 12,
                        "price" => 0
                    ],
                    [
                        "product_id" => 10,
                        "quantity" => 12,
                        "price" => 0
                    ],
                    [
                        "product_id" => 11,
                        "quantity" => 6,
                        "price" => 0
                    ],
                    [
                        "product_id" => 12,
                        "quantity" => 6,
                        "price" => 0
                    ],
                    [
                        "product_id" => 13,
                        "quantity" => 2,
                        "price" => 0
                    ],
                    [
                        "product_id" => 14,
                        "quantity" => 10,
                        "price" => 0
                    ],
                    [
                        "product_id" => 15,
                        "quantity" => 8,
                        "price" => 0
                    ],
                    [
                        "product_id" => 16,
                        "quantity" => 10,
                        "price" => 0
                    ],
                    [
                        "product_id" => 17,
                        "quantity" => 6,
                        "price" => 0
                    ],
                    [
                        "product_id" => 18,
                        "quantity" => 22,
                        "price" => 0
                    ],
                    [
                        "product_id" => 19,
                        "quantity" => 12,
                        "price" => 0
                    ],
                    [
                        "product_id" => 20,
                        "quantity" => 8,
                        "price" => 0
                    ],
                    [
                        "product_id" => 21,
                        "quantity" => 4,
                        "price" => 0
                    ],
                    [
                        "product_id" => 22,
                        "quantity" => 2,
                        "price" => 0
                    ],
                    [
                        "product_id" => 23,
                        "quantity" => 2,
                        "price" => 0
                    ],
                    [
                        "product_id" => 24,
                        "quantity" => 4,
                        "price" => 0
                    ],
                    [
                        "product_id" => 25,
                        "quantity" => 36,
                        "price" => 0
                    ],
                    [
                        "product_id" => 26,
                        "quantity" => 40,
                        "price" => 0
                    ]
                ]
            ]
        ];

        //Productos en Polvorin 1
        //80 bombas 3"
        // 200 bombas 4"
        // 200 bombas de 5"
        // 200 bombas 6"
        // 40 bombas 8"
        // 8 cake sublime 
        // 8 cake esplendor 
        // 8 cake alien 
        // 12 cake fresa 
        // 12 cake wow 
        // 6 cruz del sur azul 
        // 6 cruz del sur rojo 
        // 2 cruz del sur lluvia 
        // 10  cake bravío 
        // 8 cake indomable 
        // 10 cake maximo 
        // 6 cake perrón 
        // 22 cake Titan 
        // 12 cake smokey azul 
        // 8 cake smokey rojo 
        // 4 smokey púrpura 
        // 2 cake incógnito azul 
        // 2 cake incógnito rosa
        // 4 cake kamuro plata
        // 36 candil 1.5x8
        // 40 candil .8x10
        $inventory = Inventory::find(1);
        foreach ($purchases as $purchase) {
            $products = $purchase['products'];
            unset($purchase['products']);

            $purchase = Purchase::create($purchase);

            foreach ($products as $product) {
                $inventory->products()->attach($product['product_id'], [
                    'quantity' => $product['quantity'],
                    'price' => $product['price']
                ]);
                
                $purchase->products()->attach($product['product_id'], [
                    'quantity' => $product['quantity'],
                    'price' => $product['price']
                ]);
            }
        }
    }
}
