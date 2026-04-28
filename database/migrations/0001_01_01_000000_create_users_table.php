<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();                              // user_id (PK, BIGINT UNSIGNED)
            $table->string('name', 100);
            $table->string('username', 50)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->text('bio')->nullable();
            $table->string('avatar', 255)->nullable();
            $table->string('location', 100)->nullable();
            $table->string('website', 255)->nullable();
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->unsignedInteger('followers_count')->default(0);
            $table->unsignedInteger('following_count')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();                     // created_at, updated_at
            $table->softDeletes();                    // deleted_at (opsional)

            // Index
            $table->index('email');
            $table->index('username');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};