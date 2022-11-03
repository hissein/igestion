<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Bezhanov\Faker\Provider\Commerce;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    { $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        return [
            'name'=>$faker->productName(),
            'description'=>$this->faker->text(),
            'price'=>$this->faker->numberBetween(10,90000),
            'stock'=> $this->faker->numberBetween(1,5000),
            'stock_defective'=> $this->faker->numberBetween(2500,5000),
            'product_category_id'=>ProductCategory::inRandomOrder()->first()->id,
            'status'=>$faker->boolean()
        ];
    }
}
