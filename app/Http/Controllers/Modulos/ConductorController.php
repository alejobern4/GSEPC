<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;

class ConductorController extends Controller
{
    public function index()
    {
        $conductores = Persona::with('tipoDocumento')->get();
        return view('modulos.conductores.index', compact('conductores'));
    }

    public function create()
    {
        $tipos_documento = \App\Models\TipoDocumento::all();
        return view('modulos.conductores.actions.agregar', compact('tipos_documento'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'primer_nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'num_documento' => 'required|string|max:255|unique:personas,num_documento',
            'id_tipdocumento' => 'required|exists:tipo_documentos,id',
        ]);

        $data = $request->only([
            'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'num_documento', 'id_tipdocumento'
        ]);

        Persona::create($data);
        return redirect()->route('conductores.index')->with('success', 'Conductor agregado correctamente.');
    }

    public function eliminate()
    {
        $conductores = Persona::all();
        return view('modulos.conductores.eliminar', compact('conductores'));
    }

    public function destroy($id)
    {
        $conductor = Persona::findOrFail($id);
        $conductor->delete();
        return redirect()->route('conductores.index')->with('success', 'Conductor eliminado correctamente.');
    }

    public function edit($id)
    {
        $conductor = \App\Models\Persona::findOrFail($id);
        $tipos_documento = \App\Models\TipoDocumento::all();
        // The edit view is stored under modulos/conductores/actions/modificar.blade.php
        return view('modulos.conductores.actions.modificar', compact('conductor', 'tipos_documento'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'primer_nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'num_documento' => 'required|string|max:255|unique:personas,num_documento,' . $id,
            'id_tipdocumento' => 'required|exists:tipo_documentos,id',
        ]);
        $conductor = Persona::findOrFail($id);
        $data = $request->only([
            'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'num_documento', 'id_tipdocumento'
        ]);
        $conductor->update($data);
        return redirect()->route('conductores.index')->with('success', 'Conductor actualizado correctamente.');
    }

    public function asignarForm()
    {
        $vehiculos = \App\Models\Vehiculo::all();
        $conductores = Persona::all();
        return view('modulos.conductores.asignar', compact('vehiculos', 'conductores'));
    }

    public function asignar(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'conductor_id' => 'required|exists:personas,id',
        ]);
        $vehiculo = \App\Models\Vehiculo::findOrFail($request->vehiculo_id);
        $vehiculo->conductor_id = $request->conductor_id;
        $vehiculo->save();
        return redirect()->route('conductores.index')->with('success', 'Conductor asignado correctamente al vehículo.');
    }
}