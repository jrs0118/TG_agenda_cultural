<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Categoria;
use App\Models\Ubicacion;
use App\Models\User;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $eventos = Evento::with(['categoria', 'ubicacion', 'usuario'])
                        ->orderBy('fecha', 'desc')
                        ->paginate(15);
        
        return view('eventos.index', compact('eventos'));
    }


    public function create()
    {
        $categorias = Categoria::all();
        $ubicaciones = Ubicacion::all();
        
        return view('eventos.create', compact('categorias', 'ubicaciones'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_evento' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_ubicacion' => 'required|exists:ubicaciones,id_ubicacion',
        ]);

    $validated['id_usuario'] = Auth::id();

    Evento::create($validated);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento creado exitosamente.');
    }

    public function show(string $id)
    {
        $evento = Evento::with(['categoria', 'ubicacion', 'usuario'])
                        ->findOrFail($id);
        
        return view('eventos.show', compact('evento'));
    }


    public function edit(string $id)
    {
        $evento = Evento::findOrFail($id);
        
        // Verificar permisos
        if (Auth::id() !== $evento->id_usuario && !Auth::user()->esAdministrador()) {
            return redirect()->route('eventos.index')
                ->with('error', 'No tienes permiso para editar este evento.');
        }
        
        $categorias = Categoria::all();
        $ubicaciones = Ubicacion::all();
        
        return view('eventos.edit', compact('evento', 'categorias', 'ubicaciones'));
    }


    public function update(Request $request, string $id)
    {
        $evento = Evento::findOrFail($id);
        
        // Verificar permisos
        if (Auth::id() !== $evento->id_usuario && !Auth::user()->esAdministrador()) {
            return redirect()->route('eventos.index')
                ->with('error', 'No tienes permiso para actualizar este evento.');
        }
        
        $validated = $request->validate([
            'nombre_evento' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_ubicacion' => 'required|exists:ubicaciones,id_ubicacion',
        ]);

        $evento->update($validated);

        return redirect()->route('eventos.show', $evento->id_evento)
            ->with('success', 'Evento actualizado exitosamente.');
    }


    public function destroy(string $id)
    {
        $evento = Evento::findOrFail($id);
        
        // Verificar permisos
        if (Auth::id() !== $evento->id_usuario && !Auth::user()->esAdministrador()) {
            return redirect()->route('eventos.index')
                ->with('error', 'No tienes permiso para eliminar este evento.');
        }
        
        $evento->delete();

        return redirect()->route('eventos.index')
            ->with('success', 'Evento eliminado exitosamente.');
    }
}