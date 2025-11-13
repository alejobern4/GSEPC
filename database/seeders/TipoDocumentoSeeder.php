<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocumentoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipo_documentos')->insert([
            ['tipo_documento' => 'Cédula de Ciudadanía'],
            ['tipo_documento' => 'Cédula de Extranjería'],
            ['tipo_documento' => 'Pasaporte'],
            ['tipo_documento' => 'NIT'],
            ['tipo_documento' => 'Otro'],
        ]);
    }
}
