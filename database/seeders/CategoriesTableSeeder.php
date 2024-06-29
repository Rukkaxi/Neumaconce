<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Partes',
            'Ruedas',
            'Luces',
            'Exteriores',
            'Interiores',
            'Audio & Electrónica',
            'Herramientas',
            // Agrega aquí cualquier otra categoría que necesites
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
