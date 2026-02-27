<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Ubicacion;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventos = Evento::with(['categoria', 'ubicacion', 'usuario'])
                        ->orderBy('fecha', 'desc')
                        ->paginate(10);
        
        // Cambiado de 'eventos.index' 
        return view('evento.index', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $ubicaciones = Ubicacion::all();
        
        return view('evento.create', compact('categorias', 'ubicaciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_evento' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'id_categoria' => 'required|exists:categoria,id_categoria',
            'id_ubicacion' => 'required|exists:ubicacion,id_ubicacion',
        ]);

        // Agregar el usuario autenticado
        $validated['id_usuario'] = Auth::id();

        // Crear el evento
        Evento::create($validated);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $evento = Evento::with(['categoria', 'ubicacion', 'usuario'])
                        ->findOrFail($id);
        
        // Cambiado de 'eventos.show' a 'evento.show'
        return view('evento.show', compact('evento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $evento = Evento::findOrFail($id);
        $categorias = Categoria::all();
        $ubicaciones = Ubicacion::all();
        
        // Cambiado de 'eventos.edit' a 'evento.edit'
        return view('evento.edit', compact('evento', 'categorias', 'ubicaciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $evento = Evento::findOrFail($id);
        
        $validated = $request->validate([
            'nombre_evento' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'id_categoria' => 'required|exists:categoria,id_categoria',
            'id_ubicacion' => 'required|exists:ubicacion,id_ubicacion',
        ]);

        $evento->update($validated);

        return redirect()->route('eventos.show', $evento->id_evento)
            ->with('success', 'Evento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();

        return redirect()->route('eventos.index')
            ->with('success', 'Evento eliminado exitosamente.');
    }
}