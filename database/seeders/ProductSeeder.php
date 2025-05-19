<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // add name, description and price
        $products = [
            // Products type client
            [
                'product_role_id' => 3,
                'name' => 'Bazuca especial (diferentes colores)',
                'description' => 'Bazuca especial (diferentes colores)',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bazuca grande (diferentes colores)',
                'description' => 'Bazuca grande (diferentes colores)',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bazuca Mega (diferentes colores)',
                'description' => 'Bazuca Mega (diferentes colores)',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bengalas de azul o rosa',
                'description' => 'Bengalas de azul o rosa',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bengalas de humo azul o rosa',
                'description' => 'Bengalas de humo azul o rosa',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Blaster CO2 lanza papel picado azul o rosa',
                'description' => 'Blaster CO2 lanza papel picado azul o rosa',
                'unit' => 'Kg',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Blaster CO2 Lanza Papel Picado con Papel adicional',
                'description' => 'Blaster CO2 Lanza Papel Picado con Papel adicional',
                'unit' => 'Kg',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Blaster CO2 lanza papel picado metalico',
                'description' => 'Blaster CO2 lanza papel picado metalico',
                'unit' => 'Kg',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bomba crisantemo azul o rosa',
                'description' => 'Bomba crisantemo azul o rosa',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bomba crisantemo de colores Especial',
                'description' => 'Bomba crisantemo de colores Especial',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bomba crisantemo de colores Grande',
                'description' => 'Bomba crisantemo de colores Grande',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bomba crisantemo de colores Mega',
                'description' => 'Bombas crisantemo de colores Mega',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bombas candil efecto chicos',
                'description' => 'Bombas candil efecto chicos',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bombas chicas efecto craker y color',
                'description' => 'Bombas chicas efecto craker y color',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bombas crisantemo azul o rosa',
                'description' => 'Bombas crisantemo azul o rosa',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bombas crisantemo azul o rosa Grande',
                'description' => 'Bombas crisantemo azul o rosa Grande',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bombas crisantemo de colores Especial',
                'description' => 'Bombas crisantemo de colores Especial',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bombas crisantemo de colores Grande',
                'description' => 'Bombas crisantemo de colores Grande',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bombas crisantemo de colores Mega',
                'description' => 'Bombas crisantemo de colores Mega',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bombas crisantemos de colores grande',
                'description' => 'Bombas crisantemos de colores grande',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bombas crisantemos de colores Mega',
                'description' => 'Bombas crisantemos de colores Mega',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bombas medianas efecto cracker',
                'description' => 'Bombas medianas efecto cracker',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Bombet disparos chicos colores',
                'description' => 'Bombet disparos chicos colores',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Cake abanico diferentes efectos y colores',
                'description' => 'Cake abanico diferentes efectos y colores',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Cake abanico disparos diferentes colores y efectos',
                'description' => 'Cake abanico disparos diferentes colores y efectos',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Cake abanico disparos diferentes efectos y colore',
                'description' => 'Cake abanico disparos diferentes efectos y colore',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Cake disparos diferentes colores y efecto',
                'description' => 'Cake disparos diferentes colores y efecto',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Cake disparos diferentes efectos y colores',
                'description' => 'Cake disparos diferentes efectos y colores',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Cake especial abanico disparos medianos',
                'description' => 'Cake especial abanico disparos medianos',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Candil disparos bombet chicos',
                'description' => 'Candil disparos bombet chicos',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Castillo basico con o sin buscapies',
                'description' => 'Castillo basico con o sin buscapies',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Chisperos de luz fria 3 metros x 30 segundos',
                'description' => 'Chisperos de luz fria 3 metros x 30 segundos',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Chisperos de luz fria 3 mts x 30 segundos',
                'description' => 'Chisperos de luz fria 3 mts x 30 segundos',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Coheton de luz o trueno',
                'description' => 'Coheton de luz o trueno',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Crisantemo grande de colores',
                'description' => 'Crisantemo grande de colores',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Crisantemo Mega de colores',
                'description' => 'Crisantemo Mega de colores',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Disaparos Chicos diferentes efectos y colores',
                'description' => 'Disaparos Chicos diferentes efectos y colores',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Disaperos aereos con efecto craker y color azul o rosa',
                'description' => 'Disaperos aereos con efecto craker y color azul o rosa',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Disapros abanico con craker',
                'description' => 'Disapros abanico con craker',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Disparos bombet colores',
                'description' => 'Disparos bombet colores',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Disparos de Diferentes colores con estrobo',
                'description' => 'Disparos de Diferentes colores con estrobo',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Monotiros tricolor',
                'description' => 'Monotiros tricolor',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Puntos de disapro de humo azul o rosa con craker y diamantina',
                'description' => 'Puntos de disapro de humo azul o rosa con craker y diamantina',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Torito pirotecnico',
                'description' => 'Torito pirotecnico',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 3,
                'name' => 'Torito pirotecnico con o sin buscapies',
                'description' => 'Torito pirotecnico con o sin buscapies',
                'unit' => 'pz',
            ],
            // Products Type Inventory
            [
                'product_role_id' => 1,
                'name' => 'bombas 3"',
                'description' => 'bombas 3"',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'bombas 4"',
                'description' => 'bombas 4"',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'bombas de 5"',
                'description' => 'bombas de 5"',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'bombas 6"',
                'description' => 'bombas 6"',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'bombas 8"',
                'description' => 'bombas 8"',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cake sublime',
                'description' => 'cake sublime',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cake esplendor',
                'description' => 'cake esplendor',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cake alien',
                'description' => 'cake alien',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cake fresa',
                'description' => 'cake fresa',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cake wow',
                'description' => 'cake wow',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cruz del sur azul',
                'description' => 'cruz del sur azul',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cruz del sur rojo',
                'description' => 'cruz del sur rojo',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cruz del sur lluvia',
                'description' => 'cruz del sur lluvia',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cake bravío',
                'description' => 'cake bravío',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cake indomable',
                'description' => 'cake indomable',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cake maximo',
                'description' => 'cake maximo',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cake perrón',
                'description' => 'cake perrón',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cake Titan',
                'description' => 'cake Titan',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cake smokey azul',
                'description' => 'cake smokey azul',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cake smokey rojo',
                'description' => 'cake smokey rojo',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'smokey púrpura',
                'description' => 'smokey púrpura',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cake incógnito azul',
                'description' => 'cake incógnito azul',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cake incógnito rosa',
                'description' => 'cake incógnito rosa',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'cake kamuro plata',
                'description' => 'cake kamuro plata',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'candil 1.5x8',
                'description' => 'candil 1.5x8',
                'unit' => 'pz',
            ],
            [
                'product_role_id' => 1,
                'name' => 'candil .8x10',
                'description' => 'candil .8x10',
                'unit' => 'pz',
            ],
            // Products type Materials
        ];

        Product::insert($products);
    }
}
