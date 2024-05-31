<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BrandsTableSeeder::class,
            CategoriesTableSeeder::class, 
            TagsTableSeeder::class, 
            ProductsTableSeeder::class,
            RegionSeeder::class,
            CommunesTableSeeder::class
        ]);
    }
}
