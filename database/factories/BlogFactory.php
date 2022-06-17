<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'headline' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'image' => null,
            'image_link' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['draft', 'published']),
            'user_id' => 1
        ];
    }
}
