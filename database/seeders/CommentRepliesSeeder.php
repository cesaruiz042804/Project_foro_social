<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CommentReplie;
use App\Models\Comment;

class CommentRepliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = Comment::all(); // Obtener todos los comentarios

        foreach ($comments as $comment) {
            CommentReplie::factory()->count(rand(1, 3))->create([
                'comment_id' => $comment->id,
            ]);
        }
    }
}
