<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ConfiguracionController extends Controller
{

    public function index()
    {
    return view('configuracion.index');
    }
    
    public function updatePerfil(Request $request)
    {
        $usuario = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20'
        ]);
        
        $usuario->name = $request->name;
        $usuario->telefono = $request->telefono;
        $usuario->save();
        
        return redirect()->route('configuracion.index')
            ->with('success', 'Perfil actualizado exitosamente.');
    }
        
    public function updatePassword(Request $request)
    {
        $usuario = Auth::user();
        
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        
        // Verificar contraseña actual
        if (!Hash::check($request->current_password, $usuario->password)) {
            return redirect()->route('configuracion.index')
                ->with('error', 'La contraseña actual es incorrecta.');
        }
        
        // Actualizar contraseña
        $usuario->password = Hash::make($request->password);
        $usuario->save();
        
        return redirect()->route('configuracion.index')
            ->with('success', 'Contraseña actualizada exitosamente.');
    }
}