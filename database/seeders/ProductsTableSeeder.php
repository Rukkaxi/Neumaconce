<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Ensure there are enough brands, categories, and tags to reference
        $brandsCount = \App\Models\Brand::count();
        if ($brandsCount === 0) {
            $this->call(BrandsTableSeeder::class); // Assuming you have a BrandsTableSeeder
        }

        $categoriesCount = \App\Models\Category::count();
        if ($categoriesCount === 0) {
            $this->call(CategoriesTableSeeder::class); // Assuming you have a CategoriesTableSeeder
        }

        $tagsCount = \App\Models\Tag::count();
        if ($tagsCount === 0) {
            $this->call(TagsTableSeeder::class); // Assuming you have a TagsTableSeeder
        }

        // Create products and attach categories and tags
        Product::factory()->count(50)->create()->each(function ($product) {
            $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $tags = Tag::inRandomOrder()->take(rand(1, 3))->pluck('id');

            $product->categories()->attach($categories);
            $product->tags()->attach($tags);
        });
    }
}
