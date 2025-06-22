<?php

namespace App\Http\Controllers;

use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class UnidadMedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('can:listar unidad de medidas')->only(['index']);
        $this->middleware('can:agregar unidad de medidas')->only(['store']);
        $this->middleware('can:editar unidad de medidas')->only(['update']);
        $this->middleware('can:eliminar unidad de medidas')->only(['destroy']);
    }

    public function index()
    {
        $unidadMedidas = UnidadMedida::paginate(10);
        return view('unidadMedidas.index', compact('unidadMedidas'));
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

        UnidadMedida::create($validated);

        return redirect()->back()->with('success', 'Unidad de medida creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UnidadMedida $unidadMedida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnidadMedida $unidadMedida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnidadMedida $unidadMedida)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        $unidadMedida->update($validated);

        return redirect()->back()->with('success', 'Unidad de medida actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnidadMedida $unidadMedida)
    {
        $unidadMedida->delete();

        return redirect()->back()->with('success', 'Unidad de medida eliminada correctamente.');
    }
}
