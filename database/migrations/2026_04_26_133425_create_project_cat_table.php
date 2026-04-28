<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel pivot N:M antara projects dan categories
        Schema::create('project_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')
                  ->constrained('projects')
                  ->onDelete('cascade');
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->onDelete('cascade');
            $table->timestamps();

            // Mencegah duplikat (satu project tidak bisa masuk kategori sama 2x)
            $table->unique(['project_id', 'category_id']);
            $table->index('project_id');
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_categories');
    }
};