<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Herramienta;
use App\Models\HistorialVehiculo;
use App\Models\HistorialHerramienta;

class HistorialController extends Controller
{
    public function index()
    {
        // Unimos los elementos de vehículos y herramientas para mostrar en el historial
        $vehiculos = Vehiculo::with(['tipoVehiculo', 'detalleVehiculo.persona'])->get()->map(function($v) {
            $detalle = $v->detalleVehiculo->first();
            $tipoVehiculo = $v->tipoVehiculo ? $v->tipoVehiculo->tipo_vehiculo : '';
            $placa = $detalle ? $detalle->placa : '';
            $conductor = $detalle && $detalle->persona
                ? trim($detalle->persona->primer_nombre . ' ' . $detalle->persona->primer_apellido)
                : 'No asignado';
            return [
                'id' => $v->id,
                'tipo' => 'Vehículo',
                'marca' => $v->marca_vehiculo ?? '',
                'modelo' => $v->modelo_vehiculo ?? '',
                'tipo_vehiculo' => $tipoVehiculo,
                'placa' => $placa,
                'usuario' => $conductor,
                'nombre' => $placa ?? ($v->nombre ?? ''),
                'fecha_adquisicion' => $v->fecha_adquisicion ?? '',
                'estado' => $v->estado ?? 'Desconocido',
            ];
        });
        $herramientas = Herramienta::all()->map(function($h) {
            return [
                'id' => $h->id,
                'tipo' => 'Herramienta',
                'nombre' => isset($h->nombre) ? $h->nombre : (isset($h->descripcion) ? $h->descripcion : ''),
                'fecha_adquisicion' => isset($h->fecha_adquisicion) ? $h->fecha_adquisicion : '',
                'estado' => isset($h->estado) ? $h->estado : 'Desconocido',
            ];
        });
        $items = $vehiculos->concat($herramientas);
        return view('modulos.historial.index', compact('items'));
    }

    public function mantenimientos($id)
    {
        // Aquí puedes buscar los mantenimientos por ID y tipo
        // Ejemplo simple:
        // $mantenimientos = Mantenimiento::where('elemento_id', $id)->get();
        // return view('modulos.historial.mantenimientos', compact('mantenimientos'));
    }

    public function editar($id)
    {
        // Aquí puedes buscar el elemento y mostrar el formulario de edición
        // Ejemplo simple:
        // $item = ...;
        // return view('modulos.historial.editar', compact('item'));
    }

    public function historialVehiculo($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $historial = HistorialVehiculo::where('vehiculo_id', $id)->orderBy('fecha', 'desc')->get();
        return view('modulos.historial.vehiculo', compact('vehiculo', 'historial'));
    }

    public function historialHerramienta($id)
    {
        $herramienta = Herramienta::findOrFail($id);
        $historial = HistorialHerramienta::where('herramienta_id', $id)->orderBy('fecha', 'desc')->get();
        return view('modulos.historial.herramienta', compact('herramienta', 'historial'));
    }
}
