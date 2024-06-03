<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 1000, 50000),
            'brandId' => Brand::inRandomOrder()->first()->id,
            'stock' => $this->faker->numberBetween(0, 100),
            'description' => $this->faker->paragraph,
            'available' => $this->faker->boolean,
            'image1' => $this->faker->imageUrl(640, 480, 'products', true),
            'image2' => $this->faker->boolean ? $this->faker->imageUrl(640, 480, 'products', true) : null,
            'image3' => $this->faker->boolean ? $this->faker->imageUrl(640, 480, 'products', true) : null,
            'image4' => $this->faker->boolean ? $this->faker->imageUrl(640, 480, 'products', true) : null,
            'image5' => $this->faker->boolean ? $this->faker->imageUrl(640, 480, 'products', true) : null,
        ];
    }
}
