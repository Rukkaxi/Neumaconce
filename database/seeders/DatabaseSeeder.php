<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

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
            RegionSeeder::class,
            CommunesTableSeeder::class,
            VehiclesTableSeeder::class,
            UserSeeder::class,
            PaymentMethodsTableSeeder::class,
            ProductsTableSeeder::class,
            BranchesTableSeeder::class,
            PhotosTableSeeder::class
        ]);
    }
}
