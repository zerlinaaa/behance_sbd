<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->id();                              // follow_id (PK)

            // Dua FK ke tabel users yang sama (self-referencing)
            $table->unsignedBigInteger('follower_id');  // yang follow
            $table->unsignedBigInteger('following_id'); // yang di-follow

            $table->foreign('follower_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('following_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->timestamps();

            // Tidak boleh follow user yang sama 2x
            $table->unique(['follower_id', 'following_id']);
            // Tidak boleh follow diri sendiri (dicek di business logic/Controller)

            $table->index('follower_id');
            $table->index('following_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};