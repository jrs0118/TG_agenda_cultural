<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ubicacion extends Model
{
    use HasFactory;

    protected $table = 'ubicacion';
    protected $primaryKey = 'id_ubicacion';
    
    protected $fillable = [
        'nombre_lugar',
        'direccion',
        'ciudad',
        'capacidad'
    ];
}