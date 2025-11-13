<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Funcion;

class FuncionSeeder extends Seeder
{
    public function run(): void
    {
        Funcion::create(['funcion' => 'editar_todos_registros', 'descripcion' => 'Se puede modificar todos los registros']);
        Funcion::create(['funcion' => 'gestionar_roles', 'descripcion' => 'Editar cualquier rol de usuarios']);
        Funcion::create(['funcion' => 'restaurar_elementos_ocultos', 'descripcion' => 'Se puede modificar los elementos ocultos']);
        Funcion::create(['funcion' => 'asignar_elementos', 'descripcion' => 'Puede asignar elementos como vehiculos y prestamo de herramientas']);
        Funcion::create(['funcion' => 'ver_dashboard_general', 'descripcion' => 'Ver panel general de la aplicacion']);
        Funcion::create(['funcion' => 'ver_dashboard_admin', 'descripcion' => 'Ver panel de administrador']);
        Funcion::create(['funcion' => 'editar_usuarios', 'descripcion' => 'Puede editar los usuarios del sistema']);
        Funcion::create(['funcion' => 'ver_usuarios', 'descripcion' => 'Puede ver los usuarios del sistema']);
        Funcion::create(['funcion' => 'ver_elementos', 'descripcion' => 'Puede ver los elementos del sistema']);
        Funcion::create(['funcion' => 'ver_elementos_ocultos', 'descripcion' => 'Puede ver los elementos ocultos del sistema']);
        Funcion::create(['funcion' => 'ver_prestamos', 'descripcion' => 'Puede ver los prestamos del sistema']);
        Funcion::create(['funcion' => 'ver_historial', 'descripcion' => 'Puede ver el historial de cambios del sistema']); 
    }
}