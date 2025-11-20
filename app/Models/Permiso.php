<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{

        use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'permiso';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre de permiso'

       ];
}
