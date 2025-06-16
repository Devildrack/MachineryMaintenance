<?php

namespace App\Http\Controllers;

use App\Models\FrenteTrabajo;
use Illuminate\Http\Request;

class FrenteTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:listar frentes de trabajo')->only(['index']);
        $this->middleware('can:agregar frentes de trabajo')->only(['store']);
        $this->middleware('can:editar frentes de trabajo')->only(['update']);
        $this->middleware('can:eliminar frentes de trabajo')->only(['destroy']);
    }

    public function index()
    {
        $frentesTrabajo = FrenteTrabajo::paginate(10);
        return view('frentesTrabajo.index', compact('frentesTrabajo'));
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

        FrenteTrabajo::create($validated);

        return redirect()->back()->with('success', 'Frente de trabajo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FrenteTrabajo $frenteTrabajo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FrenteTrabajo $frenteTrabajo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FrenteTrabajo $frentesTrabajo)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        $frentesTrabajo->update($validated);
        return redirect()->back()->with('success', 'Frente de trabajo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FrenteTrabajo $frentesTrabajo)
    {
        $frentesTrabajo->delete();
        return redirect()->back()->with('success', 'Frente de trabajo eliminado correctamente.');
    }
}
