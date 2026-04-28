<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();                              // bookmark_id (PK)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->foreignId('project_id')
                  ->constrained('projects')
                  ->onDelete('cascade');
            $table->string('collection_name', 100)
                  ->default('Saved');              // Koleksi bookmark (seperti folder)
            $table->text('notes')->nullable();       // catatan pribadi user
            $table->timestamps();

            // Satu user tidak bisa bookmark project yang sama 2x
            $table->unique(['user_id', 'project_id']);
            $table->index('user_id');
            $table->index('project_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookmarks');
    }
};