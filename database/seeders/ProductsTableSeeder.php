<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Define products with their respective images and details in Spanish
        $products = [
            [
                'name' => 'Alerón Deportivo',
                'price' => 120.99,
                'brandId' => 1,
                'stock' => 50,
                'description' => 'Alerón deportivo de alta calidad para mejorar la aerodinámica del vehículo.',
                'available' => true,
                'image1' => 'storage/products/aleron.jpg',
                'category' => 'Exteriores',
                'tags' => ['spoiler', 'exteriores']
            ],
            [
                'name' => 'Alerón Aerodinámico',
                'price' => 130.99,
                'brandId' => 1,
                'stock' => 45,
                'description' => 'Alerón aerodinámico para un mejor rendimiento a altas velocidades.',
                'available' => true,
                'image1' => 'storage/products/aleron2.png',
                'category' => 'Exteriores',
                'tags' => ['spoiler', 'exteriores']
            ],
            [
                'name' => 'Dados para Ruedas',
                'price' => 9.99,
                'brandId' => 2,
                'stock' => 150,
                'description' => 'Juego de dados para ruedas, ideal para cualquier tipo de vehículo.',
                'available' => true,
                'image1' => 'storage/products/dados.jpg',
                'category' => 'Herramientas',
                'tags' => ['llantas', 'herramientas']
            ],
            [
                'name' => 'Dados de Aleación',
                'price' => 12.99,
                'brandId' => 2,
                'stock' => 120,
                'description' => 'Dados de aleación para ruedas, alta resistencia y durabilidad.',
                'available' => true,
                'image1' => 'storage/products/dados2.jpg',
                'category' => 'Herramientas',
                'tags' => ['llantas', 'herramientas']
            ],
            [
                'name' => 'Filtro de Aceite',
                'price' => 19.99,
                'brandId' => 3,
                'stock' => 100,
                'description' => 'Filtro de aceite de alta calidad para un rendimiento óptimo del motor.',
                'available' => true,
                'image1' => 'storage/products/filter.jpg',
                'category' => 'Partes',
                'tags' => ['filtro', 'motor']
            ],
            [
                'name' => 'Filtro de Aire',
                'price' => 14.99,
                'brandId' => 3,
                'stock' => 100,
                'description' => 'Filtro de aire para mejorar la eficiencia del motor.',
                'available' => true,
                'image1' => 'storage/products/filtro.jpg',
                'category' => 'Partes',
                'tags' => ['filtro', 'motor']
            ],
            [
                'name' => 'Juego de Focos LED',
                'price' => 29.99,
                'brandId' => 4,
                'stock' => 80,
                'description' => 'Juego de focos LED para mejor visibilidad en carretera.',
                'available' => true,
                'image1' => 'storage/products/focos2.jpg',
                'image2' => 'storage/products/focos.jpg',
                'image3' => 'storage/products/focos3.jpeg',
                'category' => 'Luces',
                'tags' => ['luces', 'led']
            ],
            [
                'name' => 'Gata Hidráulica',
                'price' => 39.99,
                'brandId' => 5,
                'stock' => 60,
                'description' => 'Gata hidráulica para levantar vehículos con facilidad.',
                'available' => true,
                'image1' => 'storage/products/gata.jpg',
                'category' => 'Herramientas',
                'tags' => ['herramientas', '4x4']
            ],
            [
                'name' => 'Gata Mecánica',
                'price' => 34.99,
                'brandId' => 5,
                'stock' => 55,
                'description' => 'Gata mecánica robusta y duradera.',
                'available' => true,
                'image1' => 'storage/products/gata2.jpg',
                'category' => 'Herramientas',
                'tags' => ['herramientas', '4x4']
            ],
            [
                'name' => 'Llanta Todo Terreno',
                'price' => 89.99,
                'brandId' => 6,
                'stock' => 100,
                'description' => 'Llanta todo terreno para máxima tracción en cualquier superficie.',
                'available' => true,
                'image1' => 'storage/products/llanta.png',
                'category' => 'Ruedas',
                'tags' => ['llantas', '4x4']
            ],
            [
                'name' => 'Llanta de Verano',
                'price' => 79.99,
                'brandId' => 6,
                'stock' => 90,
                'description' => 'Llanta de verano para mejor rendimiento en condiciones secas.',
                'available' => true,
                'image1' => 'storage/products/llanta2.jpg',
                'category' => 'Ruedas',
                'tags' => ['llantas', 'verano']
            ],
            [
                'name' => 'Llanta de Invierno',
                'price' => 99.99,
                'brandId' => 6,
                'stock' => 80,
                'description' => 'Llanta de invierno diseñada para condiciones climáticas frías.',
                'available' => true,
                'image1' => 'storage/products/llanta3.png',
                'category' => 'Ruedas',
                'tags' => ['llantas', 'invierno']
            ],
            [
                'name' => 'Llanta de Oro',
                'price' => 199.99,
                'brandId' => 6,
                'stock' => 70,
                'description' => 'Llanta dorada para un toque de lujo y elegancia.',
                'available' => true,
                'image1' => 'storage/products/llantaoro.jpg',
                'category' => 'Ruedas',
                'tags' => ['llantas', 'lujo']
            ],
            [
                'name' => 'Palanca de Cambios',
                'price' => 24.99,
                'brandId' => 7,
                'stock' => 100,
                'description' => 'Palanca de cambios ergonómica y duradera.',
                'available' => true,
                'image1' => 'storage/products/palanca.jpg',
                'category' => 'Interiores',
                'tags' => ['interiores', 'manual']
            ],
            [
                'name' => 'Palanca de Cambios Deportiva',
                'price' => 29.99,
                'brandId' => 7,
                'stock' => 95,
                'description' => 'Palanca de cambios deportiva para una experiencia de conducción mejorada.',
                'available' => true,
                'image1' => 'storage/products/palanca2.jpg',
                'category' => 'Interiores',
                'tags' => ['interiores', 'deportivo']
            ],
            [
                'name' => 'Palanca de Cambios de Lujo',
                'price' => 34.99,
                'brandId' => 7,
                'stock' => 90,
                'description' => 'Palanca de cambios de lujo con acabados premium.',
                'available' => true,
                'image1' => 'storage/products/palanca3.jpg',
                'category' => 'Interiores',
                'tags' => ['interiores', 'lujo']
            ],
            [
                'name' => 'Parabrisas Frontal',
                'price' => 149.99,
                'brandId' => 8,
                'stock' => 40,
                'description' => 'Parabrisas frontal resistente y duradero.',
                'available' => true,
                'image1' => 'storage/products/parabrisas.jpg',
                'category' => 'Exteriores',
                'tags' => ['exteriores', 'parabrisas']
            ],
            [
                'name' => 'Parlante para Auto',
                'price' => 49.99,
                'brandId' => 9,
                'stock' => 60,
                'description' => 'Parlante de alta calidad para un sonido nítido y claro.',
                'available' => true,
                'image1' => 'storage/products/parlante.jpg',
                'category' => 'Audio & Electrónica',
                'tags' => ['audio', 'electrónica']
            ],
            [
                'name' => 'Parlante Potente',
                'price' => 59.99,
                'brandId' => 9,
                'stock' => 55,
                'description' => 'Parlante potente para un sonido envolvente.',
                'available' => true,
                'image1' => 'storage/products/parlante2.jpg',
                'category' => 'Audio & Electrónica',
                'tags' => ['audio', 'electrónica']
            ],
            [
                'name' => 'Parlante Bluetooth',
                'price' => 69.99,
                'brandId' => 9,
                'stock' => 50,
                'description' => 'Parlante con conexión Bluetooth para mayor comodidad.',
                'available' => true,
                'image1' => 'storage/products/parlante3.jpeg',
                'category' => 'Audio & Electrónica',
                'tags' => ['audio', 'electrónica']
            ],
            [
                'name' => 'Pedales Deportivos',
                'price' => 34.99,
                'brandId' => 10,
                'stock' => 80,
                'description' => 'Juego de pedales deportivos para un mejor agarre y control.',
                'available' => true,
                'image1' => 'storage/products/pedal1.jpeg',
                'category' => 'Interiores',
                'tags' => ['pedal', 'deportivo']
            ],
            [
                'name' => 'Pedales de Aluminio',
                'price' => 39.99,
                'brandId' => 10,
                'stock' => 75,
                'description' => 'Pedales de aluminio de alta resistencia.',
                'available' => true,
                'image1' => 'storage/products/pedal2.jpg',
                'category' => 'Interiores',
                'tags' => ['pedal', 'aluminio']
            ],
            [
                'name' => 'Pedales Ajustables',
                'price' => 44.99,
                'brandId' => 10,
                'stock' => 70,
                'description' => 'Pedales ajustables para una conducción más cómoda.',
                'available' => true,
                'image1' => 'storage/products/pedal3.jpg',
                'category' => 'Interiores',
                'tags' => ['pedal', 'ajustable']
            ],
            [
                'name' => 'Motor V6',
                'price' => 599.99,
                'brandId' => 11,
                'stock' => 20,
                'description' => 'Motor V6 de alto rendimiento para una experiencia de conducción superior.',
                'available' => true,
                'image1' => 'storage/products/v6.jpg',
                'image2' => 'storage/products/v62.jpg',
                'category' => 'Partes',
                'tags' => ['motor', 'alto rendimiento']
            ],
        ];

        // Insert products into the database
        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'price' => $product['price'],
                'brandId' => $product['brandId'],
                'stock' => $product['stock'],
                'description' => $product['description'],
                'available' => $product['available'],
                'image1' => $product['image1'],
                'image2' => $product['image2'] ?? null,
                'image3' => $product['image3'] ?? null,
                'image4' => $product['image4'] ?? null,
                'image5' => $product['image5'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Fetch the last inserted product id
            $productId = DB::getPdo()->lastInsertId();

            // Attach categories and tags to the product
            $categoryId = DB::table('categories')->where('name', $product['category'])->value('id');
            if ($categoryId) {
                DB::table('category_product')->insert([
                    'product_id' => $productId,
                    'category_id' => $categoryId,
                ]);
            }

            foreach ($product['tags'] as $tag) {
                $tagId = DB::table('tags')->where('name', $tag)->value('id');
                if ($tagId) {
                    DB::table('product_tag')->insert([
                        'product_id' => $productId,
                        'tag_id' => $tagId,
                    ]);
                }
            }
        }
    }
}
