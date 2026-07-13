<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cronicas', function (Blueprint $table) {
            $table->string('resumen', 500)->nullable()->change();
            $table->text('contenido')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('cronicas', function (Blueprint $table) {
            $table->string('resumen', 100)->nullable()->change();
            $table->string('contenido', 100)->nullable()->change();
        });
    }
};