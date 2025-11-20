<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
        use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'rol';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre'
       ];
}
