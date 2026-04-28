<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();                              // like_id (PK)
            $table->foreignId('project_id')
                  ->constrained('projects')
                  ->onDelete('cascade');
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->timestamps();

            // Satu user hanya bisa like satu project sekali
            $table->unique(['project_id', 'user_id']);
            $table->index(['user_id', 'project_id']);
            $table->index('created_at');              // untuk query trend per bulan
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};