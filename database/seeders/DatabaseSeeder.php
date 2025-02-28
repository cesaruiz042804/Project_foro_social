<?php

namespace Database\Seeders;

use App\Models\Posts;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClientsSeeder::class, // Primero Users
            PostsSeeder::class, // Luego Posts (depende de Users)
            LikesSeeder::class, // Luego Likes (depende de Users y Posts)
            CommentsSeeder::class, // Luego Comments (depende de Users y Posts)
            CommentRepliesSeeder::class, // Finalmente CommentReplies (depende de Users y Comments)
        ]);
    }
}
