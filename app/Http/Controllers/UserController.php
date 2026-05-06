<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (!Auth::user()->tienePermiso('ver usuarios')) {
            abort(403, 'No tienes permiso para ver usuarios.');
        }
        
        $usuarios = User::with('rol')->orderBy('created_at', 'desc')->paginate(15);
        return view('seguridad.index', compact('usuarios'));  // ← CAMBIADO
    }
    
    public function create()
    {
        if (!Auth::user()->tienePermiso('crear usuarios')) {
            abort(403);
        }
        
        $roles = Rol::all();
        return view('seguridad.create', compact('roles'));  // ← CAMBIADO
    }
    
    public function store(Request $request)
    {
        if (!Auth::user()->tienePermiso('crear usuarios')) {
            abort(403);
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'id_rol' => 'required|exists:roles,id_rol'
        ]);
        
        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_rol' => $request->id_rol,
        ]);
        
        return redirect()->route('seguridad.index')->with('success', 'Usuario creado exitosamente.');  // ← CAMBIADO
    }
    
    public function edit($id)
    {
        if (!Auth::user()->tienePermiso('editar usuarios')) {
            abort(403);
        }
        
        $usuario = User::findOrFail($id);
        $roles = Rol::all();
        
        return view('seguridad.edit', compact('usuario', 'roles'));  // ← CAMBIADO
    }
    
    public function update(Request $request, $id)
    {
        if (!Auth::user()->tienePermiso('editar usuarios')) {
            abort(403);
        }
        
        $usuario = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'id_rol' => 'required|exists:roles,id_rol'
        ]);
        
        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'id_rol' => $request->id_rol,
        ]);
        
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8|confirmed']);
            $usuario->password = Hash::make($request->password);
            $usuario->save();
        }
        
        return redirect()->route('seguridad.index')->with('success', 'Usuario actualizado exitosamente.');  // ← CAMBIADO
    }
    
    public function destroy($id)
    {
        if (!Auth::user()->tienePermiso('eliminar usuarios')) {
            abort(403);
        }
        
        if ($id == Auth::id()) {
            return redirect()->route('seguridad.index')->with('error', 'No puedes eliminar tu propio usuario.');
        }
        
        $usuario = User::findOrFail($id);
        $usuario->delete();
        
        return redirect()->route('seguridad.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}