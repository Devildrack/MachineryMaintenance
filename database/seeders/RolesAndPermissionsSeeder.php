<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permisosAdmin = [
            'listar usuarios',
            'agregar usuarios',
            'editar usuarios',
            'eliminar usuarios',
        ];

        $permisosRoles = [
            'listar roles',
            'agregar roles',
            'editar roles',
            'eliminar roles',
        ];

        $permisosMaquinariaEquipo = [
            'listar maquinaria',
            'agregar maquinaria',
            'editar maquinaria',
            'eliminar maquinaria',
        ];

        $permisosTipoMaquinaria = [
            'listar tipo maquinaria',
            'agregar tipo maquinaria',
            'editar tipo maquinaria',
            'eliminar tipo maquinaria',
        ];

        $permisosFrenteTrabajo = [
            'listar frentes de trabajo',
            'agregar frentes de trabajo',
            'editar frentes de trabajo',
            'eliminar frentes de trabajo',
        ];

        $permisosProductos = [
            'listar productos',
            'agregar productos',
            'editar productos',
            'eliminar productos',
        ];

        $todosLosPermisos = array_unique(array_merge(
            $permisosAdmin,
            $permisosRoles,
            $permisosMaquinariaEquipo,
            $permisosTipoMaquinaria,
            $permisosFrenteTrabajo,
            $permisosProductos,
        ));

        // Creamos los permisos si no existen
        foreach ($todosLosPermisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Asignamos todos los permisos al rol admin
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions($todosLosPermisos);
    }
}
