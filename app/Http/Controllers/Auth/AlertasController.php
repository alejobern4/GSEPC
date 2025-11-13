<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\User;
use App\Models\Alerta;
use App\Models\TipoAlerta;
use App\Models\DetalleVehiculo;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AlertasController extends Controller
{
    /**
     * Envía alertas por correo a los responsables de vehículos con documentos próximos a vencer.
     */
    public function enviarAlertas()
    {
        $hoy = Carbon::now();
        $diasAlerta = 15; // Días antes del vencimiento para alertar

        // Buscar detalles de vehículos con SOAT, técnico-mecánica o mantenimiento próximos a vencer
        $detalles = DetalleVehiculo::where(function($query) use ($hoy, $diasAlerta) {
            $query->whereDate('fecha_soat', '<=', $hoy->copy()->addDays($diasAlerta))
                  ->whereDate('fecha_soat', '>=', $hoy)
                ->orWhere(function($q) use ($hoy, $diasAlerta) {
                    $q->whereDate('fecha_tecnomecanica', '<=', $hoy->copy()->addDays($diasAlerta))
                      ->whereDate('fecha_tecnomecanica', '>=', $hoy);
                })
                ->orWhere(function($q) use ($hoy, $diasAlerta) {
                    $q->whereDate('fecha_ultimo_mantenimiento', '<=', $hoy->copy()->addDays($diasAlerta))
                      ->whereDate('fecha_ultimo_mantenimiento', '>=', $hoy);
                });
        })->get();

        // Obtener todos los administradores
        $admins = \App\Models\User::whereHas('roles', function($q) {
            $q->where('rol', 'Administrador');
        })->get();

        foreach ($detalles as $detalle) {
            foreach ($admins as $admin) {
                // SOAT
                if ($detalle->fecha_soat && $detalle->fecha_soat <= $hoy->copy()->addDays($diasAlerta)) {
                    $tipoAlerta = TipoAlerta::where('tipo_alerta', 'Preventiva')->first();
                    $existe = Alerta::where('user_id', $admin->id)
                        ->where('id_detallevehiculo', $detalle->id)
                        ->where('id_tipoalerta', $tipoAlerta->id)
                        ->where('email_alerta', 'SOAT vence el ' . $detalle->fecha_soat)
                        ->exists();
                    if (!$existe) {
                        $this->registrarYEnviarAlerta($admin, $detalle, $tipoAlerta, 'SOAT vence el ' . $detalle->fecha_soat);
                    }
                }
                // Tecnomecánica
                if ($detalle->fecha_tecnomecanica && $detalle->fecha_tecnomecanica <= $hoy->copy()->addDays($diasAlerta)) {
                    $tipoAlerta = TipoAlerta::where('tipo_alerta', 'Preventiva')->first();
                    $existe = Alerta::where('user_id', $admin->id)
                        ->where('id_detallevehiculo', $detalle->id)
                        ->where('id_tipoalerta', $tipoAlerta->id)
                        ->where('email_alerta', 'Revisión técnico-mecánica vence el ' . $detalle->fecha_tecnomecanica)
                        ->exists();
                    if (!$existe) {
                        $this->registrarYEnviarAlerta($admin, $detalle, $tipoAlerta, 'Revisión técnico-mecánica vence el ' . $detalle->fecha_tecnomecanica);
                    }
                }
                // Mantenimiento
                if ($detalle->fecha_ultimo_mantenimiento && $detalle->fecha_ultimo_mantenimiento <= $hoy->copy()->addDays($diasAlerta)) {
                    $tipoAlerta = TipoAlerta::where('tipo_alerta', 'Preventiva')->first();
                    $existe = Alerta::where('user_id', $admin->id)
                        ->where('id_detallevehiculo', $detalle->id)
                        ->where('id_tipoalerta', $tipoAlerta->id)
                        ->where('email_alerta', 'Mantenimiento preventivo programado para el ' . $detalle->fecha_ultimo_mantenimiento)
                        ->exists();
                    if (!$existe) {
                        $this->registrarYEnviarAlerta($admin, $detalle, $tipoAlerta, 'Mantenimiento preventivo programado para el ' . $detalle->fecha_ultimo_mantenimiento);
                    }
                }
            }
        }
    }

    private function registrarYEnviarAlerta($responsable, $detalle, $tipoAlerta, $mensaje)
    {
        if (!$tipoAlerta) return;
        // Registrar en la base de datos
        Alerta::create([
            'user_id' => auth()->id(), // usuario autenticado actual
            'id_detallevehiculo' => $detalle->id,
            'email_alerta' => $mensaje, // el mensaje de la alerta
            'id_tipoalerta' => $tipoAlerta->id,
            'id_estadoregistro' => 1, // Activo
            'mensaje' => $mensaje,
        ]);
        // Enviar correo
        Mail::raw(
            "Atención: {$mensaje}",
            function ($message) use ($responsable) {
                $message->to($responsable->email)
                        ->subject('Alerta de vencimiento de documentos de vehículo');
            }
        );
    }

    /**
     * Muestra la lista de alertas del usuario autenticado.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        // Suponiendo que existe la relación alertas en el modelo User
        $alertas = $user->alertas()->latest()->paginate(10);
        return view('modulos.alertas.index', compact('alertas'));
    }
}
