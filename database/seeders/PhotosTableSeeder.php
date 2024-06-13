<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhotosTableSeeder extends Seeder
{
    public function run()
    {
        // Define photos with their respective paths and random texts for titles and descriptions
        $photos = [
            [
                'title' => 'Auto Deportivo',
                'description' => 'Un auto deportivo rápido y elegante.',
                'path' => 'photos/car1.jpg',
            ],
            [
                'title' => 'Auto Clásico',
                'description' => 'Un auto clásico con mucho estilo.',
                'path' => 'photos/car2.jpg',
            ],
            [
                'title' => 'SUV Familiar',
                'description' => 'Un SUV espacioso ideal para la familia.',
                'path' => 'photos/car3.jpg',
            ],
            [
                'title' => 'Auto Eléctrico',
                'description' => 'Un auto eléctrico ecológico.',
                'path' => 'photos/car4.jpg',
            ],
            [
                'title' => 'Auto de Lujo',
                'description' => 'Un auto de lujo con todas las comodidades.',
                'path' => 'photos/car5.jpg',
            ],
            [
                'title' => 'Camioneta Todo Terreno',
                'description' => 'Una camioneta todo terreno para cualquier aventura.',
                'path' => 'photos/car6.jpg',
            ],
            [
                'title' => 'Auto Convertible',
                'description' => 'Un auto convertible para disfrutar del sol.',
                'path' => 'photos/car7.jpg',
            ],
        ];

        // Insert photos into the database
        foreach ($photos as $photo) {
            DB::table('photos')->insert([
                'title' => $photo['title'],
                'description' => $photo['description'],
                'path' => $photo['path'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
