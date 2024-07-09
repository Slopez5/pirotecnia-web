<?php

namespace Database\Seeders;

use App\Models\ProductGroup;
use Illuminate\Database\Seeder;

class ProductGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $productGroups = [
            [
                'name' => 'Bazuca especial (diferentes colores)',
                'description' => 'Bazuca especial (diferentes colores)',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bazuca grande (diferentes colores)',
                'description' => 'Bazuca grande (diferentes colores)',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bazuca Mega (diferentes colores)',
                'description' => 'Bazuca Mega (diferentes colores)',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bengalas de azul o rosa',
                'description' => 'Bengalas de azul o rosa',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bengalas de humo azul o rosa',
                'description' => 'Bengalas de humo azul o rosa',
                'unit' => 'pz'
            ],
            [
                'name' => 'Blaster CO2 lanza papel picado azul o rosa',
                'description' => 'Blaster CO2 lanza papel picado azul o rosa',
                'unit' => 'Kg'
            ],
            [
                'name' => 'Blaster CO2 Lanza Papel Picado con Papel adicional',
                'description' => 'Blaster CO2 Lanza Papel Picado con Papel adicional',
                'unit' => 'Kg'
            ],
            [
                'name' => 'Blaster CO2 lanza papel picado metalico',
                'description' => 'Blaster CO2 lanza papel picado metalico',
                'unit' => 'Kg'
            ],
            [
                'name' => 'Bomba crisantemo azul o rosa',
                'description' => 'Bomba crisantemo azul o rosa',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bomba crisantemo de colores Especial',
                'description' => 'Bomba crisantemo de colores Especial',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bomba crisantemo de colores Grande',
                'description' => 'Bomba crisantemo de colores Grande',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bomba crisantemo de colores Mega',
                'description' => 'Bombas crisantemo de colores Mega',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bombas candil efecto chicos',
                'description' => 'Bombas candil efecto chicos',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bombas chicas efecto craker y color',
                'description' => 'Bombas chicas efecto craker y color',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bombas crisantemo azul o rosa',
                'description' => 'Bombas crisantemo azul o rosa',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bombas crisantemo azul o rosa Grande',
                'description' => 'Bombas crisantemo azul o rosa Grande',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bombas crisantemo de colores Especial',
                'description' => 'Bombas crisantemo de colores Especial',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bombas crisantemo de colores Grande',
                'description' => 'Bombas crisantemo de colores Grande',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bombas crisantemo de colores Mega',
                'description' => 'Bombas crisantemo de colores Mega',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bombas crisantemos de colores grande',
                'description' => 'Bombas crisantemos de colores grande',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bombas crisantemos de colores Mega',
                'description' => 'Bombas crisantemos de colores Mega',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bombas medianas efecto cracker',
                'description' => 'Bombas medianas efecto cracker',
                'unit' => 'pz'
            ],
            [
                'name' => 'Bombet disparos chicos colores',
                'description' => 'Bombet disparos chicos colores',
                'unit' => 'pz'
            ],
            [
                'name' => 'Cake abanico diferentes efectos y colores',
                'description' => 'Cake abanico diferentes efectos y colores',
                'unit' => 'pz'
            ],
            [
                'name' => 'Cake abanico disparos diferentes colores y efectos',
                'description' => 'Cake abanico disparos diferentes colores y efectos',
                'unit' => 'pz'
            ],
            [
                'name' => 'Cake abanico disparos diferentes efectos y colore',
                'description' => 'Cake abanico disparos diferentes efectos y colore',
                'unit' => 'pz'
            ],
            [
                'name' => 'Cake disparos diferentes colores y efecto',
                'description' => 'Cake disparos diferentes colores y efecto',
                'unit' => 'pz'
            ],
            [
                'name' => 'Cake disparos diferentes efectos y colores',
                'description' => 'Cake disparos diferentes efectos y colores',
                'unit' => 'pz'
            ],
            [
                'name' => 'Cake especial abanico disparos medianos',
                'description' => 'Cake especial abanico disparos medianos',
                'unit' => 'pz'
            ],
            [
                'name' => 'Candil disparos bombet chicos',
                'description' => 'Candil disparos bombet chicos',
                'unit' => 'pz'
            ],
            [
                'name' => 'Castillo basico con o sin buscapies',
                'description' => 'Castillo basico con o sin buscapies',
                'unit' => 'pz'
            ],
            [
                'name' => 'Chisperos de luz fria 3 metros x 30 segundos',
                'description' => 'Chisperos de luz fria 3 metros x 30 segundos',
                'unit' => 'pz'
            ],
            [
                'name' => 'Chisperos de luz fria 3 mts x 30 segundos',
                'description' => 'Chisperos de luz fria 3 mts x 30 segundos',
                'unit' => 'pz'
            ],
            [
                'name' => 'Coheton de luz o trueno',
                'description' => 'Coheton de luz o trueno',
                'unit' => 'pz'
            ],
            [
                'name' => 'Crisantemo grande de colores',
                'description' => 'Crisantemo grande de colores',
                'unit' => 'pz'
            ],
            [
                'name' => 'Crisantemo Mega de colores',
                'description' => 'Crisantemo Mega de colores',
                'unit' => 'pz'
            ],
            [
                'name' => 'Disaparos Chicos diferentes efectos y colores',
                'description' => 'Disaparos Chicos diferentes efectos y colores',
                'unit' => 'pz'
            ],
            [
                'name' => 'Disaperos aereos con efecto craker y color azul o rosa',
                'description' => 'Disaperos aereos con efecto craker y color azul o rosa',
                'unit' => 'pz'
            ],
            [
                'name' => 'Disapros abanico con craker',
                'description' => 'Disapros abanico con craker',
                'unit' => 'pz'
            ],
            [
                'name' => 'Disparos bombet colores',
                'description' => 'Disparos bombet colores',
                'unit' => 'pz'
            ],
            [
                'name' => 'Disparos de Diferentes colores con estrobo',
                'description' => 'Disparos de Diferentes colores con estrobo',
                'unit' => 'pz'
            ],
            [
                'name' => 'Monotiros tricolor',
                'description' => 'Monotiros tricolor',
                'unit' => 'pz'
            ],
            [
                'name' => 'Puntos de disapro de humo azul o rosa con craker y diamantina',
                'description' => 'Puntos de disapro de humo azul o rosa con craker y diamantina',
                'unit' => 'pz'
            ],
            [
                'name' => 'Torito pirotecnico',
                'description' => 'Torito pirotecnico',
                'unit' => 'pz'
            ],
            [
                'name' => 'Torito pirotecnico con o sin buscapies',
                'description' => 'Torito pirotecnico con o sin buscapies',
                'unit' => 'pz'
            ]
        ];

        ProductGroup::insert($productGroups);
    }
}
