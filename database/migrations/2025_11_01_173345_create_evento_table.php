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
        Schema::create('evento', function (Blueprint $table) {
           $table->id('id_evento'); // PK
           $table->string('nombre_evento', 100);
           $table->text('descripcion')->nullable(); // puede ser nulo si no se exige
           $table->date('fecha');
           $table->time('hora');

            // Llaves foráneas
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_ubicacion');
            $table->unsignedBigInteger('id_usuario');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evento');
    }
};
