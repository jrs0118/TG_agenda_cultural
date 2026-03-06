<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->id('id_ubicacion');
            $table->string('nombre_lugar', 255);
            $table->string('direccion', 255);
            $table->string('comuna', 50)->nullable();
            $table->string('tipo', 50)->nullable();
            $table->string('ciudad', 100)->default('Medellín');
            $table->string('departamento', 100)->default('Antioquia');
            $table->string('pais', 100)->default('Colombia');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ubicaciones');
    }
};