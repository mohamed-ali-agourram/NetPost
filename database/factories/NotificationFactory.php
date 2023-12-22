<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender' => User::factory(),
            'receiver' => User::factory(),
            'type' => $this->faker->randomElement(['POST-REACTION', 'FRIENDSHIP-REQUEST']),
            'body' => $this->faker->sentence,
            'read' => $this->faker->boolean,
            'is_shown_on_list' => $this->faker->boolean,
            'is_shown' => $this->faker->boolean,
        ];
    }
}
