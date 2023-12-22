<?php

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Config;
use App\Models\User;

class ConfigFactory extends Factory
{
    protected $model = Config::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'theme' => $this->faker->randomElement(['DARK', 'LIGHT']),
            'notifications' => $this->faker->boolean,
        ];
    }
}
