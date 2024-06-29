<?php

namespace Database\Factories;

use App\Models\Vehicle;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition()
    {
        // Get a unique word for the model
        $model = $this->faker->unique()->word;

        return [
            'model' => $model,
            'year' => $this->faker->year,
            'brandId' => Brand::factory(),
        ];
    }
}
