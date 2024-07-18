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
                        "product_id" => 46,
                        "quantity" => 80,
                        "price" => 0
                    ],
                    [
                        "product_id" => 47,
                        "quantity" => 200,
                        "price" => 0
                    ],
                    [
                        "product_id" => 48,
                        "quantity" => 200,
                        "price" => 0
                    ],
                    [
                        "product_id" => 49,
                        "quantity" => 200,
                        "price" => 0
                    ],
                    [
                        "product_id" => 50,
                        "quantity" => 40,
                        "price" => 0
                    ],
                    [
                        "product_id" => 51,
                        "quantity" => 8,
                        "price" => 0
                    ],
                    [
                        "product_id" => 52,
                        "quantity" => 8,
                        "price" => 0
                    ],
                    [
                        "product_id" => 8,
                        "quantity" => 8,
                        "price" => 0
                    ],
                    [
                        "product_id" => 53,
                        "quantity" => 12,
                        "price" => 0
                    ],
                    [
                        "product_id" => 54,
                        "quantity" => 12,
                        "price" => 0
                    ],
                    [
                        "product_id" => 55,
                        "quantity" => 6,
                        "price" => 0
                    ],
                    [
                        "product_id" => 56,
                        "quantity" => 6,
                        "price" => 0
                    ],
                    [
                        "product_id" => 57,
                        "quantity" => 2,
                        "price" => 0
                    ],
                    [
                        "product_id" => 58,
                        "quantity" => 10,
                        "price" => 0
                    ],
                    [
                        "product_id" => 59,
                        "quantity" => 8,
                        "price" => 0
                    ],
                    [
                        "product_id" => 60,
                        "quantity" => 10,
                        "price" => 0
                    ],
                    [
                        "product_id" => 61,
                        "quantity" => 6,
                        "price" => 0
                    ],
                    [
                        "product_id" => 62,
                        "quantity" => 22,
                        "price" => 0
                    ],
                    [
                        "product_id" => 63,
                        "quantity" => 12,
                        "price" => 0
                    ],
                    [
                        "product_id" => 64,
                        "quantity" => 8,
                        "price" => 0
                    ],
                    [
                        "product_id" => 65,
                        "quantity" => 4,
                        "price" => 0
                    ],
                    [
                        "product_id" => 66,
                        "quantity" => 2,
                        "price" => 0
                    ],
                    [
                        "product_id" => 67,
                        "quantity" => 2,
                        "price" => 0
                    ],
                    [
                        "product_id" => 68,
                        "quantity" => 4,
                        "price" => 0
                    ],
                    [
                        "product_id" => 69,
                        "quantity" => 36,
                        "price" => 0
                    ],
                    [
                        "product_id" => 70,
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
