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
        // 1. Crear permisos (sin campo modulo)
        $permisosData = [
            // Eventos
            ['nombre_permiso' => 'ver eventos', 'descripcion' => 'Ver lista de eventos'],
            ['nombre_permiso' => 'crear eventos', 'descripcion' => 'Crear nuevos eventos'],
            ['nombre_permiso' => 'editar eventos', 'descripcion' => 'Editar eventos existentes'],
            ['nombre_permiso' => 'eliminar eventos', 'descripcion' => 'Eliminar eventos'],
            
            // Categorías
            ['nombre_permiso' => 'ver categorias', 'descripcion' => 'Ver categorías'],
            ['nombre_permiso' => 'crear categorias', 'descripcion' => 'Crear categorías'],
            ['nombre_permiso' => 'editar categorias', 'descripcion' => 'Editar categorías'],
            ['nombre_permiso' => 'eliminar categorias', 'descripcion' => 'Eliminar categorías'],
            
            // Ubicaciones
            ['nombre_permiso' => 'ver ubicaciones', 'descripcion' => 'Ver ubicaciones'],
            ['nombre_permiso' => 'crear ubicaciones', 'descripcion' => 'Crear ubicaciones'],
            ['nombre_permiso' => 'editar ubicaciones', 'descripcion' => 'Editar ubicaciones'],
            ['nombre_permiso' => 'eliminar ubicaciones', 'descripcion' => 'Eliminar ubicaciones'],
            
            // Reportes
            ['nombre_permiso' => 'ver reportes', 'descripcion' => 'Ver módulo de reportes'],
            ['nombre_permiso' => 'generar reportes', 'descripcion' => 'Generar reportes en Excel'],
            
            // Usuarios (solo Administrador)
            ['nombre_permiso' => 'ver usuarios', 'descripcion' => 'Ver lista de gestores'],
            ['nombre_permiso' => 'crear usuarios', 'descripcion' => 'Crear gestores culturales'],
            ['nombre_permiso' => 'editar usuarios', 'descripcion' => 'Editar gestores existentes'],
            ['nombre_permiso' => 'eliminar usuarios', 'descripcion' => 'Eliminar gestores'],
        ];

        $permisosIds = [];
        foreach ($permisosData as $permisoData) {
            $permiso = Permiso::firstOrCreate(
                ['nombre_permiso' => $permisoData['nombre_permiso']],
                ['descripcion' => $permisoData['descripcion']]
            );
            $permisosIds[] = $permiso->id_permiso;
        }

        // 2. Rol Administrador (todos los permisos)
        $rolAdmin = Rol::firstOrCreate(
            ['nombre_rol' => 'Administrador'],
            ['descripcion' => 'Control total del sistema - puede crear gestores y gestionar todo']
        );
        $rolAdmin->permisos()->sync($permisosIds);

        // 3. Rol Gestor Cultural (solo eventos)
        $permisosGestor = Permiso::whereIn('nombre_permiso', [
            'ver eventos', 'crear eventos', 'editar eventos', 'eliminar eventos',
            'ver categorias', 'ver ubicaciones', 'ver reportes', 'generar reportes'
        ])->get();
        
        $rolGestor = Rol::firstOrCreate(
            ['nombre_rol' => 'Gestor Cultural'],
            ['descripcion' => 'Puede crear, editar y eliminar eventos culturales']
        );
        $rolGestor->permisos()->sync($permisosGestor->pluck('id_permiso'));

        // 4. Usuario Administrador
        User::firstOrCreate(
            ['email' => 'admin@agendacultural.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'id_rol' => $rolAdmin->id_rol
            ]
        );

        $this->command->info('✅ Roles y permisos creados exitosamente.');
        $this->command->info('📌 Administrador: admin@agendacultural.com / password');
        $this->command->info('📌 Gestor Cultural: créalo en /seguridad/usuarios');
    }
}