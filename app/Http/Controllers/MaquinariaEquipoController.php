<?php

namespace App\Http\Controllers;

use App\Models\MaquinariaEquipo;
use App\Models\TipoMaquinariaEquipo;
use Illuminate\Http\Request;

class MaquinariaEquipoController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maquinarias = MaquinariaEquipo::with('tipo')->paginate(10);
        $tipomaquinarias = TipoMaquinariaEquipo::all();
        return view('maquinarias.index', compact('maquinarias', 'tipomaquinarias'));
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
            'tipo_maquinaria_equipo_id' => 'required|exists:tipo_maquinaria_equipos,id',
            'modelo' => 'nullable|string|max:100',
            'marca' => 'nullable|string|max:100',
            'numero_serie' => 'nullable|string|max:100',
            'propietario' => 'nullable|string|max:100',
            'frente_trabajo' => 'nullable|string|max:100',
            'fecha_alta' => 'nullable|date',
            'tipo_combustible' => 'nullable|string|max:50',
            'fecha_ultimo_servicio' => 'nullable|date',
            'horometro_ultimo_servicio' => 'nullable|numeric',
            'condicion' => 'nullable|string|max:50',
            'estatus' => 'nullable|string|max:50',
        ]);

        MaquinariaEquipo::create($validated);

        return redirect()->back()->with('success', 'Maquinaria/Equipo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MaquinariaEquipo $maquinariaEquipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaquinariaEquipo $maquinariaEquipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaquinariaEquipo $maquinaria)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
            'tipo_maquinaria_equipo_id' => 'required|exists:tipo_maquinaria_equipos,id',
            'modelo' => 'nullable|string|max:100',
            'marca' => 'nullable|string|max:100',
            'numero_serie' => 'nullable|string|max:100',
            'propietario' => 'nullable|string|max:100',
            'frente_trabajo' => 'nullable|string|max:100',
            'fecha_alta' => 'nullable|date',
            'tipo_combustible' => 'nullable|string|max:50',
            'fecha_ultimo_servicio' => 'nullable|date',
            'horometro_ultimo_servicio' => 'nullable|numeric',
            'condicion' => 'nullable|string|max:50',
            'estatus' => 'nullable|string|max:50',
        ]);

        $maquinaria->update($validated);

        return redirect()->back()->with('success', 'Maquinaria/Equipo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaquinariaEquipo $maquinaria)
    {
        $maquinaria->delete();

        return redirect()->back()->with('success', 'Maquinaria/Equipo eliminado correctamente.');
    }
}
