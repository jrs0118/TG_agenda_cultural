<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permisos';
    protected $primaryKey = 'id_permiso';
    
    protected $fillable = [
        'nombre_permiso',
        'descripcion'
    ];

    // relación con roles- un permiso puede tener muchos roles

    public function roles()
    {
        return $this->belongsToMany(
            Rol::class, 
            'rol_permiso', 
            'id_permiso', 
            'id_rol'
        )->withTimestamps();
    }
}