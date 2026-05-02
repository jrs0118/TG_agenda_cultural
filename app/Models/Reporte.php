<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reporte extends Model
{
    use HasFactory;

    protected $table = 'reportes';
    protected $primaryKey = 'id_reporte';
    
    protected $fillable = [
        'nombre_reporte',
        'tipo_reporte',
        'filtros_aplicados',
        'ruta_archivo',
        'id_usuario',
        'fecha_generacion'
    ];

    protected $casts = [
        'filtros_aplicados' => 'array',
        'fecha_generacion' => 'datetime'
    ];

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
}