<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all(); // Obtener todos los posts

        foreach ($posts as $post) {
            Comment::factory()->count(rand(5, 10))->create([
                'post_id' => $post->id,
            ]);
        }
    }
}
