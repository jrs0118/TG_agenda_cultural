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

    
    public function usuarios()
    {
        return $this->hasMany(User::class, 'id_rol', 'id_rol');
    }


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