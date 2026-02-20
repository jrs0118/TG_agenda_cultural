<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evento', function (Blueprint $table) {
           $table->id('id_evento');
           $table->string('nombre_evento', 100);
           $table->text('descripcion')->nullable();
           $table->date('fecha');
           $table->time('hora');

            // Llaves foráneas
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_ubicacion');
            $table->unsignedBigInteger('id_usuario');
            
            // Definir las relaciones foráneas
            $table->foreign('id_categoria')
                  ->references('id_categoria')
                  ->on('categoria')
                  ->onDelete('restrict');

            $table->foreign('id_ubicacion')
                  ->references('id_ubicacion')
                  ->on('ubicacion')
                  ->onDelete('restrict');

            $table->foreign('id_usuario')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evento');
    }
};