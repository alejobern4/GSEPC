<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
use App\Models\Funcion;

class FuncionRolSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Rol::where('rol', 'Administrador')->first();
        $coordinador = Rol::where('rol', 'Coordinador')->first();
        $usuario = Rol::where('rol', 'Usuario')->first();

        $funciones = Funcion::pluck('id', 'funcion');

        $admin->funciones()->sync([
            $funciones['editar_todos_registros'],
            $funciones['gestionar_roles'],
            $funciones['restaurar_elementos_ocultos'],
            $funciones['asignar_elementos'],
            $funciones['ver_dashboard_general'],
            $funciones['ver_dashboard_admin'],
            $funciones['editar_usuarios'],
            $funciones['ver_usuarios'],
            $funciones['ver_elementos'],
            $funciones['ver_elementos_ocultos'],
            $funciones['ver_prestamos'],
            $funciones['ver_historial'],
        ]);

        $coordinador->funciones()->sync([
            $funciones['asignar_elementos'],
            $funciones['ver_dashboard_general'],
            $funciones['ver_usuarios'],
            $funciones['ver_prestamos'],
        ]);

        $usuario->funciones()->sync([
            $funciones['ver_dashboard_general'],
            $funciones['ver_elementos'],

        ]);
    }
}
