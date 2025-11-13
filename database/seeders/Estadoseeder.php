<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estados')->insert([
            ['estado' => 'Disponible'],//Verde (Activo)
            ['estado' => 'Prestado'],//Amarillo (En ruta) (Asignado compactadores tractor(operando)) (Prestado para motos o que se presten)
            ['estado' => 'Fuera de servicio'],//Rojo (Mantenimiento)
            ['estado' => 'Inactivo'],//Morado
        ]);
    }
}