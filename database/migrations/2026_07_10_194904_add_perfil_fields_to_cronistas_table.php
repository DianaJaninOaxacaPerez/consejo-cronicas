<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cronistas', function (Blueprint $table) {
            $table->string('cargo', 100)->nullable()->after('materno');
            $table->string('foto')->nullable()->after('cargo');
            $table->text('biografia')->nullable()->after('foto');
        });
    }

    public function down(): void
    {
        Schema::table('cronistas', function (Blueprint $table) {
            $table->dropColumn(['cargo', 'foto', 'biografia']);
        });
    }
};