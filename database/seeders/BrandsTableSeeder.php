<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        // Create 10 brands using the BrandFactory
        Brand::factory()->count(10)->create();
    }
}
