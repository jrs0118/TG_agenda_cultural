<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
use App\Models\Permiso;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesYPermisosSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear permisos SOLO si no existen
        $permisosData = [
            ['nombre_permiso' => 'crear_eventos', 'descripcion' => 'Permite crear nuevos eventos'],
            ['nombre_permiso' => 'editar_eventos', 'descripcion' => 'Permite modificar eventos existentes'],
            ['nombre_permiso' => 'eliminar_eventos', 'descripcion' => 'Permite eliminar eventos'],
            ['nombre_permiso' => 'ver_reportes', 'descripcion' => 'Permite acceder a estadísticas'],
            ['nombre_permiso' => 'gestionar_categorias', 'descripcion' => 'Permite administrar categorías'],
            ['nombre_permiso' => 'gestionar_ubicaciones', 'descripcion' => 'Permite administrar ubicaciones'],
        ];

        $permisosIds = [];
        foreach ($permisosData as $permisoData) {
            $permiso = Permiso::firstOrCreate(
                ['nombre_permiso' => $permisoData['nombre_permiso']],
                ['descripcion' => $permisoData['descripcion']]
            );
            $permisosIds[] = $permiso->id_permiso;
        }

        // 2. Crear rol Administrador SOLO si no existe
        $rolAdmin = Rol::firstOrCreate(
            ['nombre_rol' => 'Administrador'],
            ['descripcion' => 'Acceso total al sistema']
        );

        // 3. Asignar permisos al rol (evitar duplicados)
        $rolAdmin->permisos()->sync($permisosIds);

        // 4. Crear usuario administrador SOLO si no existe
        $user = User::firstOrCreate(
            ['email' => 'admin@agendacultural.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'id_rol' => $rolAdmin->id_rol
            ]
        );

        $this->command->info('✅ Seeders ejecutados correctamente (evitando duplicados).');
    }
}