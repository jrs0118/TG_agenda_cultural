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
        'direccion',      
        'comuna',         
        'tipo',           
        'ciudad',         
        'departamento',   
        'pais',           
        'observaciones'   
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**Una ubicación puede tener muchos eventos*/
    public function eventos()
    {
        return $this->hasMany(Evento::class, 'id_ubicacion', 'id_ubicacion');
    }

    /**Accesor para obtener nombre completo de la ubicación */
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->direccion}, {$this->ciudad} - {$this->pais}";
    }
}