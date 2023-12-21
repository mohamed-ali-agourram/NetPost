<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Friendship;
use App\Models\Notification;
use App\Models\Config;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed Users
        User::factory(10)->create()->each(function ($user) {
            // For each user, create posts
            Post::factory(rand(1, 5))->create(['user_id' => $user->id]);

            // Create a config for each user
            Config::create([
                'user_id' => $user->id,
                'theme' => rand(0, 1) ? 'DARK' : 'LIGHT',
                'notifications' => rand(0, 1)
            ]);

            // Create comments for some of the posts
            Comment::factory(rand(1, 3))->create(['user_id' => $user->id]);

            // Create friendships
            Friendship::factory(rand(1, 3))->create(['user_id' => $user->id]);
        });

        // Seed Notifications independently
        Notification::factory(20)->create();
    }
}
