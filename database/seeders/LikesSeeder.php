<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Post;
use App\Models\Like;

class LikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //$users = Client::factory()->count(3)->create(); // Crea 3 usuarios
        //$posts = Post::factory()->count(15)->create(); // Crea 15 posts
        $users = Client::all();
        $posts = Post::all();

        foreach ($posts as $post) {
            $usersToLike = $users->random(rand(5, 10)); // Elige aleatoriamente algunos usuarios para dar like a este post
            foreach ($usersToLike as $user) {
                Like::factory()->create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);
            }
        }
    }
}
