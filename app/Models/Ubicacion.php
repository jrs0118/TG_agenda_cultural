<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'ubicacion';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'direccion',
        'ciudad',
        'pais',
       ];
}

