<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id_rol';
    
    protected $fillable = [
        'nombre_rol',
        'descripcion'
    ];

    /**
     * Relación con Usuarios (1:N)
     * Un rol puede tener muchos usuarios
     */
    public function usuarios()
    {
        return $this->hasMany(User::class, 'id_rol', 'id_rol');
    }

    /**
     * Relación con Permisos (N:N)
     * Un rol puede tener muchos permisos
     */
    public function permisos()
    {
        return $this->belongsToMany(
            Permiso::class, 
            'rol_permiso', 
            'id_rol', 
            'id_permiso'
        )->withTimestamps();
    }
}