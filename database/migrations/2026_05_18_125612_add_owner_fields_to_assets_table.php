<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->string('owner_name')->nullable()->after('status');
            $table->string('owner_username')->nullable()->after('owner_name');
            $table->string('_source_url')->nullable()->after('owner_username');
            $table->string('_category_hint')->nullable()->after('_source_url');
        });
    }

    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn(['owner_name', 'owner_username', '_source_url', '_category_hint']);
        });
    }
};