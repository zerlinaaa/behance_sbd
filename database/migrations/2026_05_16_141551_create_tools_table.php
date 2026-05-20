<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // CREATE TABLE tools (
        //   id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        //   name        VARCHAR(100) UNIQUE NOT NULL,
        //   slug        VARCHAR(100) UNIQUE NOT NULL,
        //   icon        VARCHAR(255) NULL,
        //   created_at  TIMESTAMP NULL,
        //   updated_at  TIMESTAMP NULL,
        //   INDEX idx_slug (slug)
        // );

        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('slug', 100)->unique();
            $table->string('icon', 255)->nullable();
            $table->timestamps();
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};