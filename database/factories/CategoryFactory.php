<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = str($this->faker->words(2, true))->title();

        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'description' => $this->faker->text(200),
        ];
    }
}
