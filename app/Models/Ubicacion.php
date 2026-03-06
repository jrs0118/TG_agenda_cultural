<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ubicacion extends Model
{
    use HasFactory;

    protected $table = 'ubicaciones';
    protected $primaryKey = 'id_ubicacion';
    
    protected $fillable = [
        'nombre_lugar',
        'direccion',
        'comuna',
        'tipo',
        'ciudad',
        'departamento',
        'pais',
        'observaciones'
    ];

    protected $attributes = [
        'ciudad' => 'Medellín',
        'departamento' => 'Antioquia',
        'pais' => 'Colombia'
    ];

    /**
     * Relación con Eventos (1:N)
     * Una ubicación puede tener muchos eventos
     */
    public function eventos()
    {
        return $this->hasMany(Evento::class, 'id_ubicacion', 'id_ubicacion');
    }

    /**
     * Obtener dirección completa formateada
     */
    public function getDireccionCompletaAttribute()
    {
        return "{$this->direccion}, {$this->comuna}, {$this->ciudad} - {$this->pais}";
    }
}