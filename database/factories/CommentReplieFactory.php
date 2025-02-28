<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client; // Importa el modelo User
use App\Models\Comment; // Importa el modelo Comment

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentReply>
 */
class CommentReplieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => Client::factory(), // Crea un User y usa su ID
            'comment_id' => Comment::factory(), // Crea un Comment y usa su ID
            'reply' => $this->faker->sentence(), // Genera una frase aleatoria como respuesta
        ];
    }
}
