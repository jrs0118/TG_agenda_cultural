<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UbicacionController extends Controller
{
    
    public function index()
    {
        $ubicaciones = Ubicacion::withCount('eventos')->get();
        return view('ubicaciones.index', compact('ubicaciones'));
    }


    public function create()
    {
        return view('ubicaciones.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_lugar' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'comuna' => 'nullable|string|max:50',
            'tipo' => 'nullable|string|max:50',
            'ciudad' => 'nullable|string|max:100',
            'departamento' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string',
        ]);

        Ubicacion::create($validated);

        return redirect()->route('ubicaciones.index')
            ->with('success', 'Ubicación creada exitosamente.');
    }


    public function show(string $id)
    {
        $ubicacion = Ubicacion::with('eventos')->findOrFail($id);
        return view('ubicaciones.show', compact('ubicacion'));
    }


    public function edit(string $id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        return view('ubicaciones.edit', compact('ubicacion'));
    }


    public function update(Request $request, string $id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        
        $validated = $request->validate([
            'nombre_lugar' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'comuna' => 'nullable|string|max:50',
            'tipo' => 'nullable|string|max:50',
            'ciudad' => 'nullable|string|max:100',
            'departamento' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string',
        ]);

        $ubicacion->update($validated);

        return redirect()->route('ubicaciones.show', $ubicacion->id_ubicacion)
            ->with('success', 'Ubicación actualizada exitosamente.');
    }

    
    public function destroy(string $id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        
        if ($ubicacion->eventos()->count() > 0) {
            return redirect()->route('ubicaciones.index')
                ->with('error', 'No se puede eliminar la ubicación porque tiene eventos asociados.');
        }
        
        $ubicacion->delete();

        return redirect()->route('ubicaciones.index')
            ->with('success', 'Ubicación eliminada exitosamente.');
    }
}