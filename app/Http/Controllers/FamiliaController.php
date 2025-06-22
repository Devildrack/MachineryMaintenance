<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use Illuminate\Http\Request;

class FamiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('can:listar familias')->only(['index']);
        $this->middleware('can:agregar familias')->only(['store']);
        $this->middleware('can:editar familias')->only(['update']);
        $this->middleware('can:eliminar familias')->only(['destroy']);
    }

    public function index()
    {
        $familias = Familia::paginate(10);
        return view('familias.index', compact('familias'));
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

        Familia::create($validated);

        return redirect()->back()->with('success', 'Familia creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Familia $familia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Familia $familia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Familia $familia)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        $familia->update($validated);

        return redirect()->back()->with('success', 'Familia actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Familia $familia)
    {
        $familia->delete();

        return redirect()->back()->with('success', 'Familia eliminada correctamente.');
    }
}
