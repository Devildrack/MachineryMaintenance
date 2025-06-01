<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Notifications\EmailVerify;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:listar usuarios')->only(['index']);
        $this->middleware('can:agregar usuarios')->only(['create', 'store']);
        $this->middleware('can:editar usuarios')->only(['edit', 'update']);
        $this->middleware('can:eliminar usuarios')->only(['destroy']);
    }


    public function index()
    {
        $users = User::paginate(100);
        $roles = Role::all();
        return view('usuarios.index', compact('users', 'roles'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'apellidos' => 'nullable|string|max:255',
            'rfc' => 'nullable|string|max:13',
            'domicilio' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'telefono_oficina' => 'nullable|string|max:20',
            'role' => 'required|exists:roles,id',
        ]);

        $data = $request->only([
            'name',
            'email',
            'apellidos',
            'rfc',
            'domicilio',
            'telefono',
            'telefono_oficina'
        ]);

        // Generar contraseña temporal de 8 dígitos numéricos entre 1 y 9
        $tempPassword = collect(range(1, 9))->random(8)->join('');

        $data['pass_temp'] = $tempPassword;
        $data['password'] = bcrypt($tempPassword);
        $data['estatus'] = 1;

        $user = User::create($data);

        // Asignar rol con Spatie
        $roleName = Role::find($request->role)->name;
        $user->assignRole($roleName);
        $user->notify(new EmailVerify($user));

        // Opcional: notificar al usuario por correo con su contraseña
        // Mail::to($user->email)->send(new NuevaCuentaUsuario($user, $tempPassword));

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
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
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'apellidos' => 'nullable|string|max:255',
            'rfc' => 'nullable|string|max:13',
            'domicilio' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'telefono_oficina' => 'nullable|string|max:20',
            'estatus' => 'required|boolean',
            'role' => 'required|exists:roles,id',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'apellidos' => $validated['apellidos'] ?? null,
            'rfc' => $validated['rfc'] ?? null,
            'domicilio' => $validated['domicilio'] ?? null,
            'telefono' => $validated['telefono'] ?? null,
            'telefono_oficina' => $validated['telefono_oficina'] ?? null,
            'estatus' => $validated['estatus'],
        ]);

        $roleName = Role::findOrFail($validated['role'])->name;
        $user->syncRoles([$roleName]);


        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
