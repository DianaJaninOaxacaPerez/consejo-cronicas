<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('cronicas')) {
            return; // ya existe, no la tocamos
        }

        Schema::create('cronicas', function (Blueprint $table) {
            $table->increments('id_cronica');
            $table->text('titulo');
            $table->text('autor');
            $table->date('fecha')->nullable();
            $table->string('resumen', 100)->nullable();
            $table->string('contenido', 100)->nullable();
            $table->string('imagen', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cronicas');
    }
};