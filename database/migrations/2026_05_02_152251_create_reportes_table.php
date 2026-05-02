¿¿¿<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id('id_reporte');
            $table->string('nombre_reporte', 200);
            $table->enum('tipo_reporte', ['listado', 'resumen', 'estadistico']);
            $table->json('filtros_aplicados')->nullable();
            $table->string('ruta_archivo', 500);
            $table->unsignedBigInteger('id_usuario');
            $table->timestamp('fecha_generacion');
            $table->timestamps();
            
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reportes');
    }
};