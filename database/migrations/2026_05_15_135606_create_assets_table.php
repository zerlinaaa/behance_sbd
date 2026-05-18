<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->enum('asset_type', ['font', 'template', 'mockup', 'icon', 'illustration', 'other'])->default('other');
            $table->enum('license', ['free', 'premium'])->default('free');
            $table->decimal('price', 8, 2)->nullable();         // null = free
            $table->string('currency', 10)->default('USD');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->unsignedInteger('views_count')->default(0);
            $table->unsignedInteger('likes_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};