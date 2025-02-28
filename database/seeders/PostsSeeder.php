<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Post;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Client::factory()->count(5)->create(); // Crea 5 usuarios primero

        Post::factory()->count(20)->create(); // Genera 20 posts usando PostFactory (cada post se relacionará con un User creado por UserFactory)
    }
}
