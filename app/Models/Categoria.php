<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    
    protected $fillable = [
        'nombre_categoria',
        'descripcion'
    ];

    /**
     * Relación con Eventos (1:N)
     * Una categoría puede tener muchos eventos
     */
    public function eventos()
    {
        return $this->hasMany(Evento::class, 'id_categoria', 'id_categoria');
    }

    /**
     * Scope para buscar por nombre
     */
    public function scopeNombre($query, $nombre)
    {
        return $query->where('nombre_categoria', 'like', "%{$nombre}%");
    }
}