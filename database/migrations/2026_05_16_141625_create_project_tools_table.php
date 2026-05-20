<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // CREATE TABLE project_tools (
        //   id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        //   project_id  BIGINT UNSIGNED NOT NULL,
        //   tool_id     BIGINT UNSIGNED NOT NULL,
        //   created_at  TIMESTAMP NULL,
        //   updated_at  TIMESTAMP NULL,
        //   UNIQUE KEY uq_project_tool (project_id, tool_id),
        //   FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
        //   FOREIGN KEY (tool_id)    REFERENCES tools(id)    ON DELETE CASCADE
        // );

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