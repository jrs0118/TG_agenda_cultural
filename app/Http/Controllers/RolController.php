<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolController extends Controller
{
   
    /**
     * Listar roles y asignar permisos
     */
    public function index()
    {
        // if (!Auth::user()->tienePermiso('ver roles')) {
        //     abort(403);
        // }
        
        $roles = Rol::with('permisos')->get();
        $permisos = Permiso::all();
        
        return view('rol.index', compact('roles', 'permisos'));  // ← CAMBIADO
    }
    /**
     * Actualizar permisos de un rol
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->tienePermiso('editar roles')) {
            abort(403);
        }
        
        $rol = Rol::findOrFail($id);
        $permisosSeleccionados = $request->permisos ?? [];
        
        $rol->permisos()->sync($permisosSeleccionados);
        
        return redirect()->route('seguridad.roles.index')
            ->with('success', 'Permisos actualizados exitosamente.');
    }
}