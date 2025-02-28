<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key, BIGINT UNSIGNED, column name 'id'
            $table->foreignId('user_id')->constrained('clients')->onDelete('cascade'); // Foreign key to users table, UNSIGNED BIGINT, column name 'user_id'
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade'); // Foreign key to posts table, UNSIGNED BIGINT, column name 'post_id'
            $table->timestamps(); // created_at and updated_at TIMESTAMP columns - (aunque en este caso solo usamos created_at en la definición SQL original, puedes dejar ambos timestamps o quitar updated_at si lo prefieres)
            $table->unique(['user_id', 'post_id']); // Define a unique index on user_id and post_id to prevent duplicate likes from the same user on the same post
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
