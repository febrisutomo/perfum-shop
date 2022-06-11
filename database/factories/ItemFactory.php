<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = Str::title($this->faker->sentence(3));
        $cost_price = $this->faker->numberBetween(1, 9) * 10000;
        $price = $cost_price + $cost_price * 5/100;

        return [
            'name' => $name,
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'slug' => Str::slug($name),
            'images' => [
                [
                    'uuid' => "fce6728e-dd89-4316-a0bb-e05cc0fc9cb2",
                    'path' => "default.jpg",
                ]
            ],
            'summary' =>$this->faker->text(150),
            'description' =>$this->faker->text(1000),
            'ingredients' =>$this->faker->text(400),
            'stock' => $this->faker->numberBetween(1, 100),
            'cost_price' => $cost_price,
            'price' => $price,
        ];
    }
}
