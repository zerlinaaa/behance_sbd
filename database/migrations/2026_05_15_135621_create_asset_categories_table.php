<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel pivot N:M antara assets dan categories
        // Pola sama persis dengan project_categories
        Schema::create('asset_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')
                  ->constrained('assets')
                  ->onDelete('cascade');
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->onDelete('cascade');
            $table->timestamps();
            // Mencegah duplikat
            $table->unique(['asset_id', 'category_id']);
            $table->index('asset_id');
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_categories');
    }
};