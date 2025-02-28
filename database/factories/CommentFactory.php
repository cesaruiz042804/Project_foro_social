<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client; // Importa el modelo User
use App\Models\Post; // Importa el modelo Comment

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
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
            'post_id' => Post::factory(), // Crea un Post y usa su ID
            'comment' => $this->faker->sentence(), // Genera una frase aleatoria como comentario
        ];
    }
}
