<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\User;

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
        $title = fake()->sentence();

        return [
            'title' => $title,
            'url_clean' => Str::slug($title),
            'content' => fake()->randomHtml(2, 3),
            'posted' => fake()->boolean ? 'yes' : 'not',
            'category_id' => Category::inRandomOrder()->first()?->id,
            'user_id' => User::inRandomOrder()->first()?->id, 
        ];
    }
}

