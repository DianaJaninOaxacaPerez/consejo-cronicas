<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::table('cronistas', function (Blueprint $table) {
            $table->string('youtube')->nullable()->after('telefono');
            $table->string('facebook')->nullable()->after('youtube');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::table('cronistas', function (Blueprint $table) {
        $table->dropColumn(['youtube', 'facebook']);
    });
    }
};
