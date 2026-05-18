<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_tools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')
                  ->constrained('projects')
                  ->onDelete('cascade');
            $table->foreignId('tool_id')
                  ->constrained('tools')
                  ->onDelete('cascade');
            $table->timestamps();
            $table->unique(['project_id', 'tool_id']);
            $table->index('project_id');
            $table->index('tool_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_tools');
    }
};