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
       /*  Schema::create('ubicacion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });*/

        Schema::create('ubicacion', function (Blueprint $table) {
            $table->id();
            $table->string('direccion')->nullable();
            $table->string('comuna', 50)->nullable();
            $table->string('tipo', 50)->nullable(); 
            // ejemplo: oficina / bodega
            $table->string('ciudad', 100)->default('Medellin');
            $table->string('departamento', 100)->default('Antioquia');
            $table->string('pais', 100)->default('Colombia');
            $table->text('observaciones')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicacion');
    }
};


##dejar los campos tal cual