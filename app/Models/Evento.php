<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evento extends Model
{
    use HasFactory;

    // Mantenemos 'evento' en singular como tú lo tienes
    protected $table = 'evento';

    protected $primaryKey = 'id_evento';

    // ¡CORREGIDO! Los campos fillable deben coincidir con la BD
    protected $fillable = [
        'nombre_evento',  // Sin espacios
        'descripcion',
        'fecha',
        'hora',
        'id_categoria',   // Así se llama en la BD
        'id_ubicacion',   // Así se llama en la BD
        'id_usuario'      // Así se llama en la BD
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i:s'
    ];

    // Relaciones
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion', 'id_ubicacion');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
}