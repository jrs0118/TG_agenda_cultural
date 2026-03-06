<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';
    protected $primaryKey = 'id_evento';
    
    protected $fillable = [
        'nombre_evento',
        'descripcion',
        'fecha',
        'hora',
        'id_categoria',
        'id_ubicacion',
        'id_usuario'
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i:s'
    ];

    /**
     * Relación con Categoría (N:1)
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    /**
     * Relación con Ubicación (N:1)
     */
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion', 'id_ubicacion');
    }

    /**
     * Relación con Usuario (N:1)
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    /**
     * Scope para eventos futuros
     */
    public function scopeFuturos($query)
    {
        return $query->where('fecha', '>=', now()->toDateString())
                     ->orderBy('fecha', 'asc')
                     ->orderBy('hora', 'asc');
    }

    /**
     * Scope para eventos por categoría
     */
    public function scopePorCategoria($query, $categoriaId)
    {
        return $query->where('id_categoria', $categoriaId);
    }

    /**
     * Scope para eventos por ubicación
     */
    public function scopePorUbicacion($query, $ubicacionId)
    {
        return $query->where('id_ubicacion', $ubicacionId);
    }

    /**
     * Obtener fecha formateada
     */
    public function getFechaFormateadaAttribute()
    {
        return $this->fecha->format('d/m/Y');
    }

    /**
     * Obtener hora formateada
     */
    public function getHoraFormateadaAttribute()
    {
        return $this->hora->format('g:i A');
    }
}