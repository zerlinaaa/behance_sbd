<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();                              // project_id (PK)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');           // FK → users
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('cover_image', 255)->nullable();
            $table->string('slug')->unique();       // URL-friendly
            $table->enum('status', ['draft', 'published', 'archived'])
                  ->default('published');
            $table->unsignedInteger('views_count')->default(0);
            $table->unsignedInteger('likes_count')->default(0);  // di-update Trigger
            $table->unsignedInteger('comments_count')->default(0);
            $table->timestamps();

            // Index untuk pencarian & sorting
            $table->index('user_id');
            $table->index('status');
            $table->index('created_at');
            $table->index(['status', 'created_at']);   // composite index
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};