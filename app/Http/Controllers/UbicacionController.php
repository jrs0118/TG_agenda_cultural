<?php

namespace App\Http\Controllers;
// Model de Ubicaciones
use App\Models\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        // 1. Obtener todos los registros del modelo Ubicacion
             $ubicaciones = Ubicacion::all();

        // 2. Retornar la vista 'ubicaciones.index' y pasarle las ubicaciones
            return view('ubicaciones.index', [
            'ubicaciones' => $ubicaciones
        ]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
