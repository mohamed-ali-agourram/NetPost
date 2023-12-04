<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\Config;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            // Create User
            $user = User::create([
                'name' => $faker->name,
                'slug' => $faker->slug,
                'cover_image' => $faker->imageUrl(),
                'profile_image' => $faker->imageUrl(),
                'status' => $faker->sentence,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make('0000'),
                'remember_token' => Str::random(10),
            ]);

            // Create Config
            $config = Config::create([
                'user_id' => $user->id,
                'theme' => $faker->randomElement(['DARK', 'LIGHT']),
                'notifications' => $faker->boolean,
            ]);

            // Create 5 Posts
            for ($i = 0; $i < 5; $i++) {
                Post::create([
                    'user_id' => $user->id,
                    'body' => $faker->paragraph,
                    'image' => $faker->imageUrl(),
                    'is_published' => $faker->boolean,
                    'published_at' => $faker->dateTimeThisMonth,
                    'featured' => $faker->boolean,
                    'is_profile_update' => $faker->boolean,
                ]);
            }
        }
    }
}
