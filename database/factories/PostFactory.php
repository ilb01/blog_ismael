<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word(),
            'url_clean' => fake()->unique()->word(),
            'content' => fake()->text(200),
            'user_id' => fake()->randomNumber(1,10),
            'category_id' => fake()->randomNumber(1,10)
        ];
    }
}
