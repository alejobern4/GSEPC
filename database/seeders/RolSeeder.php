<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        Rol::create(['rol' => 'Administrador', 'descripcion' => 'Acceso completo']);
        Rol::create(['rol' => 'Coordinador', 'descripcion' => 'Acceso medio']);
        Rol::create(['rol' => 'Usuario', 'descripcion' => 'Acceso limitado']);
    }
}
