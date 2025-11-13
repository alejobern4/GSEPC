<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoAlertasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('tipo_alertas')->insert([
            [
                'tipo_alerta' => 'Preventiva',
                'descripcion' => 'Alerta por mantenimiento preventivo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_alerta' => 'Correctiva',
                'descripcion' => 'Alerta por mantenimiento correctivo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_alerta' => 'A tiempo',
                'descripcion' => 'Alerta generada el mismo día',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
