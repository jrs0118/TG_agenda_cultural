<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id('id_evento');
            $table->string('nombre_evento', 100);
            $table->text('descripcion')->nullable();
            $table->date('fecha');
            $table->time('hora');
            
            // Llaves foráneas
            $table->foreignId('id_categoria')
                  ->constrained('categorias', 'id_categoria')
                  ->onDelete('restrict');
                  
            $table->foreignId('id_ubicacion')
                  ->constrained('ubicaciones', 'id_ubicacion')
                  ->onDelete('restrict');
                  
            $table->foreignId('id_usuario')
                  ->constrained('users', 'id')
                  ->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};