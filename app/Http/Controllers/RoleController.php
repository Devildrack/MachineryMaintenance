<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('can:listar roles')->only(['index']);
        $this->middleware('can:agregar roles')->only(['create', 'store']);
        $this->middleware('can:editar roles')->only(['edit', 'update']);
        $this->middleware('can:eliminar roles')->only(['destroy']);
    }


    public function index()
    {
        // Obtener todos los roles con sus permisos
        $roles = Role::with('permissions')->paginate(10);
        $permissions = Permission::all();
        return view('roles.index', compact('roles', 'permissions'));
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
        $request->validate([
            'name' => 'required|string|unique:roles,name|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Crear el rol
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);


        // Asignar permisos si vienen
        if ($request->filled('permissions')) {
            $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissionNames);
        }

        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
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
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->name = $request->name;
        $role->guard_name = 'web';
        $role->save();

        if ($request->filled('permissions')) {
            $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissionNames);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        // Quitar todos los permisos del rol (limpia la tabla pivote)
        $role->permissions()->detach();

        // Eliminar el rol
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Rol y sus permisos eliminados correctamente.');
    }
}
