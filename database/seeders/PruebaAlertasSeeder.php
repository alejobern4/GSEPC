<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Rol;
use App\Models\User;
use App\Models\Persona;
use App\Models\Vehiculo;

class PruebaAlertasSeeder extends Seeder
{
    public function run()
    {
        // 1. Crear roles
        $adminRol = Rol::firstOrCreate(['rol' => 'Administrador']);
        $coordRol = Rol::firstOrCreate(['rol' => 'Coordinador']);

        // 2. Crear personas responsables
        $personaAdmin = Persona::firstOrCreate([
            'primer_nombre' => 'Admin',
            'primer_apellido' => 'Prueba',
            'num_documento' => '123345678',
            'id_tipdocumento' => '1'

        ]);
        $personaCoord = Persona::firstOrCreate([
            'primer_nombre' => 'Coord',
            'primer_apellido' => 'Prueba',
            'num_documento' => '1233456789',
            'id_tipdocumento' => '1'
        ]);

        // Personas adicionales (deben crearse antes de usarse)
        $personaExtra1 = Persona::firstOrCreate([
            'primer_nombre' => 'Extra1',
            'primer_apellido' => 'Persona',
            'num_documento' => '111111111',
            'id_tipdocumento' => '1'
        ]);
        $personaExtra2 = Persona::firstOrCreate([
            'primer_nombre' => 'Extra2',
            'primer_apellido' => 'Persona',
            'num_documento' => '222222222',
            'id_tipdocumento' => '1'
        ]);

        // 3. Crear usuarios y asociar roles y personas
        $userAdmin = User::firstOrCreate([
            'email' => 'admin@prueba.com',
        ], [
            'password' => Hash::make('password'),
            'id_persona' => $personaAdmin->id,
        ]);
        $userCoord = User::firstOrCreate([
            'email' => 'coord@prueba.com',
        ], [
            'password' => Hash::make('password'),
            'id_persona' => $personaCoord->id,
        ]);

        // Asignar roles usando la tabla intermedia
        if (method_exists($userAdmin, 'roles')) {
            $userAdmin->roles()->sync([$adminRol->id]);
        }
        if (method_exists($userCoord, 'roles')) {
            $userCoord->roles()->sync([$coordRol->id]);
        }

        // 4. Crear vehículos con fechas próximas a vencer y responsables
        $tipoVehiculoId = 1; // Ajusta según tu seeder de tipo_vehiculos
        $vehiculo1 = Vehiculo::create([
            'modelo_vehiculo' => 'Corolla',
            'marca_vehiculo' => 'Toyota',
            'anio' => 2020,
            'id_tipovehiculo' => $tipoVehiculoId,
        ]);
        $vehiculo2 = Vehiculo::create([
            'modelo_vehiculo' => 'CX-5',
            'marca_vehiculo' => 'Mazda',
            'anio' => 2021,
            'id_tipovehiculo' => $tipoVehiculoId,
        ]);
        $vehiculo3 = Vehiculo::create([
            'modelo_vehiculo' => 'Sail',
            'marca_vehiculo' => 'Chevrolet',
            'anio' => 2019,
            'id_tipovehiculo' => $tipoVehiculoId,
        ]);
        $vehiculo4 = Vehiculo::create([
            'modelo_vehiculo' => 'Ranger',
            'marca_vehiculo' => 'Ford',
            'anio' => 2018,
            'id_tipovehiculo' => $tipoVehiculoId,
        ]);

        // Crear detalles de vehículos con fechas próximas a vencer y responsables
        DB::table('detalle_vehiculos')->insert([
            [
                'id_vehiculo' => $vehiculo1->id,
                'persona_id' => $userAdmin->id,
                'id_estado' => 1, // Ajusta según tu seeder de estados
                'id_estadoregistro' => 1, // Ajusta según tu seeder de estado_registros
                'placa' => 'AAA111',
                'conductor_auxiliar' => null,
                'fecha_solicitud' => now()->subDays(2),
                'fecha_devolucion' => null,
                'fecha_soat' => now()->addDays(5),
                'fecha_tecnomecanica' => now()->addDays(10),
                'imagen_vehiculo' => null,
                'fecha_ultimo_mantenimiento' => now()->subMonths(6),
                'descripcion_ultimo_mantenimiento' => 'Cambio de aceite',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_vehiculo' => $vehiculo2->id,
                'persona_id' => $userCoord->id,
                'id_estado' => 1,
                'id_estadoregistro' => 1,
                'placa' => 'BBB222',
                'conductor_auxiliar' => null,
                'fecha_solicitud' => now()->subDays(3),
                'fecha_devolucion' => null,
                'fecha_soat' => now()->addDays(7),
                'fecha_tecnomecanica' => now()->addDays(14),
                'imagen_vehiculo' => null,
                'fecha_ultimo_mantenimiento' => now()->subMonths(5),
                'descripcion_ultimo_mantenimiento' => 'Revisión general',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Detalles de vehículos adicionales
        DB::table('detalle_vehiculos')->insert([
            [
                'id_vehiculo' => $vehiculo3->id,
                'persona_id' => $personaExtra1->id,
                'id_estado' => 2, // Prestado
                'id_estadoregistro' => 1,
                'placa' => 'CCC333',
                'conductor_auxiliar' => null,
                'fecha_solicitud' => now()->subDays(1),
                'fecha_devolucion' => null,
                'fecha_soat' => now()->addDays(3),
                'fecha_tecnomecanica' => now()->addDays(8),
                'imagen_vehiculo' => null,
                'fecha_ultimo_mantenimiento' => now()->subMonths(4),
                'descripcion_ultimo_mantenimiento' => 'Cambio de frenos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_vehiculo' => $vehiculo4->id,
                'persona_id' => $personaExtra2->id,
                'id_estado' => 3, // Fuera de servicio
                'id_estadoregistro' => 1,
                'placa' => 'DDD444',
                'conductor_auxiliar' => null,
                'fecha_solicitud' => now()->subDays(5),
                'fecha_devolucion' => null,
                'fecha_soat' => now()->addDays(2),
                'fecha_tecnomecanica' => now()->addDays(5),
                'imagen_vehiculo' => null,
                'fecha_ultimo_mantenimiento' => now()->subMonths(2),
                'descripcion_ultimo_mantenimiento' => 'Cambio de llantas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Compactador
        $compactador1 = Vehiculo::create([
            'modelo_vehiculo' => 'SD160',
            'marca_vehiculo' => 'Volvo',
            'anio' => 2022,
            'id_tipovehiculo' => 2, // Compactador
            'nombre' => 'Compactador 1',
        ]);
        $compactador2 = Vehiculo::create([
            'modelo_vehiculo' => 'CS44B',
            'marca_vehiculo' => 'Caterpillar',
            'anio' => 2021,
            'id_tipovehiculo' => 2,
            'nombre' => 'Compactador 2',
        ]);
        DB::table('detalle_vehiculos')->insert([
            [
                'id_vehiculo' => $compactador1->id,
                'persona_id' => $personaExtra1->id,
                'id_estado' => 1,
                'id_estadoregistro' => 1,
                'placa' => 'COM111',
                'conductor_auxiliar' => null,
                'fecha_solicitud' => now()->subDays(2),
                'fecha_devolucion' => null,
                'fecha_soat' => now()->addDays(10),
                'fecha_tecnomecanica' => now()->addDays(20),
                'imagen_vehiculo' => null,
                'fecha_ultimo_mantenimiento' => now()->subMonths(2),
                'descripcion_ultimo_mantenimiento' => 'Revisión hidráulica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_vehiculo' => $compactador2->id,
                'persona_id' => $personaExtra2->id,
                'id_estado' => 2,
                'id_estadoregistro' => 1,
                'placa' => 'COM222',
                'conductor_auxiliar' => null,
                'fecha_solicitud' => now()->subDays(3),
                'fecha_devolucion' => null,
                'fecha_soat' => now()->addDays(12),
                'fecha_tecnomecanica' => now()->addDays(22),
                'imagen_vehiculo' => null,
                'fecha_ultimo_mantenimiento' => now()->subMonths(3),
                'descripcion_ultimo_mantenimiento' => 'Cambio de rodillos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        // Motos
        $moto1 = Vehiculo::create([
            'modelo_vehiculo' => 'FZ25',
            'marca_vehiculo' => 'Yamaha',
            'anio' => 2023,
            'id_tipovehiculo' => 3,
            'nombre' => 'Moto 1',
        ]);
        $moto2 = Vehiculo::create([
            'modelo_vehiculo' => 'CB190R',
            'marca_vehiculo' => 'Honda',
            'anio' => 2022,
            'id_tipovehiculo' => 3,
            'nombre' => 'Moto 2',
        ]);
        DB::table('detalle_vehiculos')->insert([
            [
                'id_vehiculo' => $moto1->id,
                'persona_id' => $personaExtra1->id,
                'id_estado' => 1,
                'id_estadoregistro' => 1,
                'placa' => 'MOT111',
                'conductor_auxiliar' => null,
                'fecha_solicitud' => now()->subDays(1),
                'fecha_devolucion' => null,
                'fecha_soat' => now()->addDays(8),
                'fecha_tecnomecanica' => now()->addDays(16),
                'imagen_vehiculo' => null,
                'fecha_ultimo_mantenimiento' => now()->subMonths(1),
                'descripcion_ultimo_mantenimiento' => 'Cambio de aceite',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_vehiculo' => $moto2->id,
                'persona_id' => $personaExtra2->id,
                'id_estado' => 2,
                'id_estadoregistro' => 1,
                'placa' => 'MOT222',
                'conductor_auxiliar' => null,
                'fecha_solicitud' => now()->subDays(2),
                'fecha_devolucion' => null,
                'fecha_soat' => now()->addDays(9),
                'fecha_tecnomecanica' => now()->addDays(18),
                'imagen_vehiculo' => null,
                'fecha_ultimo_mantenimiento' => now()->subMonths(2),
                'descripcion_ultimo_mantenimiento' => 'Cambio de llantas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        // Otros
        $otro1 = Vehiculo::create([
            'modelo_vehiculo' => '5045E',
            'marca_vehiculo' => 'John Deere',
            'anio' => 2020,
            'id_tipovehiculo' => 4,
            'nombre' => 'Otro 1',
        ]);
        $otro2 = Vehiculo::create([
            'modelo_vehiculo' => 'L2501',
            'marca_vehiculo' => 'Kubota',
            'anio' => 2017,
            'id_tipovehiculo' => 4,
            'nombre' => 'Otro 2',
        ]);
        DB::table('detalle_vehiculos')->insert([
            [
                'id_vehiculo' => $otro1->id,
                'persona_id' => $personaExtra1->id,
                'id_estado' => 1,
                'id_estadoregistro' => 1,
                'placa' => 'OTR111',
                'conductor_auxiliar' => null,
                'fecha_solicitud' => now()->subDays(4),
                'fecha_devolucion' => null,
                'fecha_soat' => now()->addDays(11),
                'fecha_tecnomecanica' => now()->addDays(21),
                'imagen_vehiculo' => null,
                'fecha_ultimo_mantenimiento' => now()->subMonths(5),
                'descripcion_ultimo_mantenimiento' => 'Revisión eléctrica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_vehiculo' => $otro2->id,
                'persona_id' => $personaExtra2->id,
                'id_estado' => 2,
                'id_estadoregistro' => 1,
                'placa' => 'OTR222',
                'conductor_auxiliar' => null,
                'fecha_solicitud' => now()->subDays(6),
                'fecha_devolucion' => null,
                'fecha_soat' => now()->addDays(13),
                'fecha_tecnomecanica' => now()->addDays(23),
                'imagen_vehiculo' => null,
                'fecha_ultimo_mantenimiento' => now()->subMonths(6),
                'descripcion_ultimo_mantenimiento' => 'Cambio de filtro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 5. Crear mantenimientos de prueba para los detalles de vehículos
        $tipoMantId = DB::table('tipo_mantenimientos')->insertGetId([
            'mantenimiento' => 'General',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $detalleVehiculos = DB::table('detalle_vehiculos')->get();
        foreach ($detalleVehiculos as $detalle) {
            DB::table('mantenimientos')->insert([
                [
                    'id_detallevehiculo' => $detalle->id,
                    'fecha_mantenimiento' => now()->subMonths(6),
                    'id_tipomantenimiento' => $tipoMantId,
                    'detalles_mantenimiento' => 'Cambio de aceite',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_detallevehiculo' => $detalle->id,
                    'fecha_mantenimiento' => now()->subMonths(3),
                    'id_tipomantenimiento' => $tipoMantId,
                    'detalles_mantenimiento' => 'Revisión general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
        // Más mantenimientos para todos los detalles
        $tipoMantId2 = DB::table('tipo_mantenimientos')->insertGetId([
            'mantenimiento' => 'Correctivo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        foreach ($detalleVehiculos as $detalle) {
            DB::table('mantenimientos')->insert([
                [
                    'id_detallevehiculo' => $detalle->id,
                    'fecha_mantenimiento' => now()->subMonths(1),
                    'id_tipomantenimiento' => $tipoMantId2,
                    'detalles_mantenimiento' => 'Cambio de batería',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
        // Más roles y usuarios
        $rolMecanico = Rol::firstOrCreate(['rol' => 'Mecánico']);
        $personaMecanico = Persona::firstOrCreate([
            'primer_nombre' => 'Meca',
            'primer_apellido' => 'Nico',
            'num_documento' => '333333333',
            'id_tipdocumento' => '1'
        ]);
        $userMecanico = User::firstOrCreate([
            'email' => 'mecanico@prueba.com',
        ], [
            'password' => Hash::make('password'),
            'id_persona' => $personaMecanico->id,
        ]);
        if (method_exists($userMecanico, 'roles')) {
            $userMecanico->roles()->sync([$rolMecanico->id]);
        }

        // 6. Crear documentos de prueba para cada detalle de vehículo
        foreach ($detalleVehiculos as $detalle) {
            DB::table('vehiculo_documentos')->insert([
                [
                    'id_detallevehiculo' => $detalle->id,
                    'nombre' => 'SOAT',
                    'fecha' => now()->subMonths(1),
                    'ruta' => 'documentos/soat_' . $detalle->id . '.pdf',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_detallevehiculo' => $detalle->id,
                    'nombre' => 'Tecnomecánica',
                    'fecha' => now()->subMonths(2),
                    'ruta' => 'documentos/tecno_' . $detalle->id . '.pdf',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
