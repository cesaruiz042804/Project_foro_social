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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key, BIGINT UNSIGNED, column name 'id'
            $table->foreignId('user_id')->constrained('clients')->onDelete('cascade'); // Foreign key to users table, UNSIGNED BIGINT, column name 'user_id'
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade'); // Foreign key to posts table, UNSIGNED BIGINT, column name 'post_id'
            $table->text('comment'); // TEXT column for comment text
            $table->timestamps(); // created_at and updated_at TIMESTAMP columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
