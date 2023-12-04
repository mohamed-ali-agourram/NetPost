<?php

namespace Database\Factories;

use App\Models\User;
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
            'user_id' => User::factory(),
            'body' => $this->faker->text,
            'image' => $this->faker->imageUrl(),
            'is_published' => $this->faker->randomElement(['0', '1']),
            'published_at' => $this->faker->dateTime(),
            'featured' => $this->faker->boolean(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'deleted_at' => null,
            'is_profile_update' => $this->faker->boolean(),
        ];
    }
}
