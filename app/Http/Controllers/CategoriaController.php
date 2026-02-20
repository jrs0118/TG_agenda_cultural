<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categoria.index', compact('categorias'));
    }

    public function create()
    {
        return view('categoria.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_categoria' => 'required|string|max:100|unique:categoria,nombre_categoria',
            'tipo_categoria' => 'required|in:Música,Danza,Artes Plásticas,Audiovisuales,Teatro,Otro',
        ]);

        Categoria::create($validated);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría creada exitosamente.');
    }

    public function edit(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categoria.edit', compact('categoria'));
    }

    public function update(Request $request, string $id)
    {
        $categoria = Categoria::findOrFail($id);
        
        $validated = $request->validate([
            'nombre_categoria' => 'required|string|max:100|unique:categoria,nombre_categoria,' . $id . ',id_categoria',
            'tipo_categoria' => 'required|in:Música,Danza,Artes Plásticas,Audiovisuales,Teatro,Otro',
        ]);

        $categoria->update($validated);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        
        if ($categoria->eventos()->count() > 0) {
            return redirect()->route('categorias.index')
                ->with('error', 'No se puede eliminar la categoría porque tiene eventos asociados.');
        }
        
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría eliminada exitosamente.');
    }
}