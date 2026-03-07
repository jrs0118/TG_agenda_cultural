<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Categoria;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $query = Evento::with(['categoria', 'ubicacion'])
                      ->where('fecha', '>=', now()->toDateString());

        // Filtros
        if ($request->filled('categoria')) {
            $query->where('id_categoria', $request->categoria);
        }

        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        $eventos = $query->orderBy('fecha')
                        ->orderBy('hora')
                        ->paginate(12);

        $categorias = Categoria::all();

        return view('welcome', compact('eventos', 'categorias'));
    }
}