<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoRegistroSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('estado_registros')->insert([
            ['estado_registro' => 'Activo'],
            ['estado_registro' => 'Oculto'],
        ]);
    }
}
