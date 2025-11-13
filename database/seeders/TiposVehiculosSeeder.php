<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposVehiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_vehiculos')->insert([
            ['tipo_vehiculo' => 'Camionetas'],
            ['tipo_vehiculo' => 'Compactadores'],
            ['tipo_vehiculo' => 'Motos'],
            ['tipo_vehiculo' => 'Otro'],
        ]);
    }
}
