<?php

namespace App\Http\Controllers;

use App\Models\TipoMaquinariaEquipo;
use Illuminate\Http\Request;

class TipoMaquinariaEquipoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:listar tipo maquinaria')->only(['index']);
        $this->middleware('can:agregar tipo maquinaria')->only(['store']);
        $this->middleware('can:editar tipo maquinaria')->only(['update']);
        $this->middleware('can:eliminar tipo maquinaria')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipomaquinarias = TipoMaquinariaEquipo::paginate(10);
        return view('tipomaquinarias.index', compact('tipomaquinarias'));
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
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        $tipo = TipoMaquinariaEquipo::create($validated);

        return redirect()->back()->with('success', 'Tipo de maquinaria creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoMaquinariaEquipo $tipoMaquinariaEquipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoMaquinariaEquipo $tipoMaquinariaEquipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoMaquinariaEquipo $tipomaquinaria)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        $tipomaquinaria->update($validated);

        return redirect()->back()->with('success', 'Tipo de maquinaria actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoMaquinariaEquipo $tipomaquinaria)
    {
        $tipomaquinaria->delete();

        return redirect()->back()->with('success', 'Tipo de maquinaria eliminado correctamente.');
    }
}
