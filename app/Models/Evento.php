<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    //
    use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención)
    protected $table = 'evento';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre de evento',
        'descripcion',
        'fecha',
        'hora',
        'categoria',
        'ubicacion',
        'usuario'

    ];





}
