<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categoria';
    protected $primaryKey = 'id_categoria';
    
    protected $fillable = [
        'nombre_categoria',
        'tipo_categoria' // ← NUEVO CAMPO
    ];
    
    protected $casts = [
        'tipo_categoria' => 'string'
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class, 'id_categoria', 'id_categoria');
    }
}