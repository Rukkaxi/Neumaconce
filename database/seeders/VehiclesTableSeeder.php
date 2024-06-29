<?php
// database/seeders/VehiclesTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\Brand;

class VehiclesTableSeeder extends Seeder
{
    public function run()
    {
        // Ensure brands are created first
        $brands = Brand::all();

        if ($brands->isEmpty()) {
            // Create 10 brands if none exist
            $brands = Brand::factory()->count(10)->create();
        }

        // Create vehicles
        Vehicle::factory()->count(50)->create()->each(function ($vehicle) use ($brands) {
            // Get a random index within the range of available brands
            $randomIndex = rand(0, $brands->count() - 1);

            // Get the brand at the random index and assign its ID to the vehicle
            $vehicle->update([
                'brandId' => $brands[$randomIndex]->id,
            ]);
        });
    }
}
