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
        Schema::table('categoria', function (Blueprint $table) {
            $table->enum('tipo_categoria', [
                'Música',
                'Danza',
                'Artes Plásticas',
                'Audiovisuales',
                'Teatro',
                'Otro'
            ])->default('Otro')->after('nombre_categoria'); // Agrega después de nombre_categoria
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categoria', function (Blueprint $table) {
            $table->dropColumn('tipo_categoria');
        });
    }
};