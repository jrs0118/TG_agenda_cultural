<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
        use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'categoria';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre de categoria'        
       ];
}
