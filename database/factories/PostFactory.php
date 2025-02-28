<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client; // Importa el modelo Client
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => Client::factory(), // Crea un User y usa su ID (relación)
            'content' => $this->faker->paragraph(), // Genera un párrafo de texto aleatorio
        ];
    }
}
