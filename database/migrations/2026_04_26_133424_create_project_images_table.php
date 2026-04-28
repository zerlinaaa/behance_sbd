<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_images', function (Blueprint $table) {
            $table->id();                              // image_id (PK)
            $table->foreignId('project_id')
                  ->constrained('projects')
                  ->onDelete('cascade');           // FK → projects
            $table->string('image_path', 255);      // path file / URL
            $table->string('caption', 255)->nullable();
            $table->unsignedTinyInteger('sort_order')->default(0); // urutan tampil
            $table->string('mime_type', 50)->nullable();  // image/jpeg, dst
            $table->unsignedBigInteger('file_size')->nullable(); // bytes
            $table->timestamps();

            // Index
            $table->index('project_id');
            $table->index(['project_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_images');
    }
};