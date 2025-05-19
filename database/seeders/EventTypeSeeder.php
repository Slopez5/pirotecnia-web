<?php

namespace Database\Seeders;

use App\Models\EventType;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventTypes = [
            [
                'name' => 'Boda',
                'description' => 'Boda',
            ],
            [
                'name' => 'XV años',
                'description' => 'XV años',
            ],
            [
                'name' => 'Bautizo',
                'description' => 'Bautizo',
            ],
            [
                'name' => 'Primera Comunión',
                'description' => 'Primera Comunión',
            ],
            [
                'name' => 'Cumpleaños',
                'description' => 'Cumpleaños',
            ],
            [
                'name' => 'Aniversario',
                'description' => 'Aniversario',
            ],
            [
                'name' => 'Graduación',
                'description' => 'Graduación',
            ],
        ];

        foreach ($eventTypes as $eventType) {
            EventType::create($eventType);
        }

    }
}
