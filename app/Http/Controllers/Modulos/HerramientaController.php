<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Herramienta;

class HerramientaController extends Controller
{
    public function index()
    {
        $herramientas = Herramienta::all();
        return view('modulos.herramientas.index', compact('herramientas'));
    }

    public function mecanicas()
    {
        $mecanicas = Herramienta::with('tipoHerramienta')
                        ->where('id_tipoherramienta', 1)
                        ->get();
        return view('modulos.herramientas.tipos.mecanicas', compact('mecanicas'));
    }

    public function electricas()
    {
        $electricas = Herramienta::with('tipoHerramienta')
                        ->where('id_tipoherramienta', 2)
                        ->get();
        return view('modulos.herramientas.tipos.electricas', compact('electricas'));
    }

    public function medicion()
    {
        $medicion = Herramienta::with('tipoHerramienta')
                        ->where('id_tipoherramienta', 3)
                        ->get();
        return view('modulos.herramientas.tipos.medicion', compact('medicion'));
    }

    public function otros()
    {
        $otros = Herramienta::with('tipoHerramienta')
                        ->where('id_tipoherramienta', 4)
                        ->get();
        return view('modulos.herramientas.tipos.otros', compact('otros'));
    }

    //Acciones

    public function create()
    {
        return view('modulos.herramientas.agregar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_herramienta_id' => 'required|integer',
            'descripcion' => 'nullable|string',
        ]);
        Herramienta::create($request->all());
        return redirect()->route('herramientas.index')->with('success', 'Herramienta agregada correctamente.');
    }

    public function edit($id)
    {
        $herramienta = Herramienta::findOrFail($id);
        return view('modulos.herramientas.edit', compact('herramienta'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_herramienta_id' => 'required|integer',
            'descripcion' => 'nullable|string',
        ]);
        $herramienta = Herramienta::findOrFail($id);
        $herramienta->update($request->all());
        return redirect()->route('herramientas.index')->with('success', 'Herramienta actualizada correctamente.');
    }

    public function eliminate()
    {
        $herramientas = Herramienta::all();
        return view('modulos.herramientas.eliminar', compact('herramientas'));
    }

    public function destroy($id)
    {
        try {
            $herramienta = Herramienta::findOrFail($id);
            $herramienta->id_estadoregistro = 2; // 2 = Inactivo
            $herramienta->save();
            return response()->json(['success' => true, 'message' => 'Herramienta eliminada correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al eliminar la herramienta.'], 500);
        }
    }

    public function asignarForm()
    {
        $herramientas = Herramienta::all();
        $personas = \App\Models\Persona::all();
        return view('modulos.herramientas.asignar', compact('herramientas', 'personas'));
    }

    public function asignar(Request $request)
    {
        $request->validate([
            'herramienta_id' => 'required|exists:herramientas,id',
            'persona_id' => 'required|exists:personas,id',
        ]);
        $herramienta = Herramienta::findOrFail($request->herramienta_id);
        $herramienta->persona_id = $request->persona_id;
        $herramienta->save();
        return redirect()->route('herramientas.index')->with('success', 'Herramienta asignada correctamente.');
    }
}