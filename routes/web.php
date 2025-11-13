<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Modulos\VehiculoController;
use App\Http\Controllers\Modulos\VehiculoDocumentoController;
use App\Http\Controllers\Modulos\HerramientaController;
use App\Http\Controllers\Modulos\ConductorController;
use App\Http\Controllers\Modulos\HuggingFaceChatController;
use App\Http\Controllers\Modulos\HFTestController;
use App\Http\Controllers\Auth\AlertasController;
use App\Http\Controllers\Modulos\HistorialController;


Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        app(\App\Http\Controllers\Auth\AlertasController::class)->enviarAlertas();
        return app(\App\Http\Controllers\DashboardController::class)->index();
    })->name('dashboard');
    
    //-------------------------------------------------------------------------------------------------------------------------
    //Vehiculos
    Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('vehiculos.index');
    Route::get('/vehiculos/camionetas', [VehiculoController::class,'camionetas'])->name('vehiculos.camionetas');
    Route::get('/vehiculos/compactadores', [VehiculoController::class,'compactadores'])->name('vehiculos.compactadores');
    Route::get('/vehiculos/motos', [VehiculoController::class, 'motos'])->name('vehiculos.motos');
    Route::get('/vehiculos/otros', [VehiculoController::class,'otros'])->name('vehiculos.otros');
    
    //Actions
    Route::get('/vehiculos/agregar', [VehiculoController::class, 'create'])->name('vehiculos.create');
    Route::post('/vehiculos', [VehiculoController::class, 'store'])->name('vehiculos.store');
    Route::get('/vehiculos/modificar/{vehiculo}', [VehiculoController::class, 'edit'])->name('vehiculos.edit');
    Route::put('/vehiculos/modificar/{vehiculo}', [VehiculoController::class, 'update'])->name('vehiculos.update');
    Route::get('/vehiculos/eliminar', [VehiculoController::class, 'eliminate'])->name('vehiculos.eliminate');
    Route::delete('/vehiculos/{id}', [VehiculoController::class, 'destroy'])->name('vehiculos.destroy');
    
    // Rutas para modificar y asignar vehículos
    Route::get('/vehiculos/acciones/asignar/{detalle}', [VehiculoController::class, 'asignarVehiculoSeleccionado'])->name('vehiculos.asignar.seleccionado');
    Route::get('/vehiculos/asignar', [VehiculoController::class, 'asignarForm'])->name('vehiculos.asignar.form');
    Route::post('/vehiculos/asignar', [VehiculoController::class, 'asignar'])->name('vehiculos.asignar.store');

    Route::post('/vehiculos/devolver', [VehiculoController::class, 'devolver'])->name('vehiculos.devolver');
    
    Route::patch('/vehiculos/{vehiculo}/estado', [VehiculoController::class, 'cambiarEstado'])->name('vehiculos.cambiarEstado');

    //-------------------------------------------------------------------------------------------------------------------------
    //Herramientas
    Route::get('/herramientas', [HerramientaController::class, 'index'])->name('herramientas.index');
    Route::get('/herramientas/mecanicas', [HerramientaController::class, 'mecanicas'])->name('herramientas.mecanicas');
    Route::get('/herramientas/electricas', [HerramientaController::class, 'electricas'])->name('herramientas.electricas');
    Route::get('/herramientas/medicion', [HerramientaController::class, 'medicion'])->name('herramientas.medicion');
    Route::get('/herramientas/otros', [HerramientaController::class, 'otros'])->name('herramientas.otros');
    
    // Actions
    Route::get('/herramientas/agregar', [HerramientaController::class, 'create'])->name('herramientas.create');
    Route::post('/herramientas', [HerramientaController::class, 'store'])->name('herramientas.store');
    Route::get('/herramientas/modificar/{herramienta}', [HerramientaController::class, 'edit'])->name('herramientas.edit');
    Route::put('/herramientas/modificar/{herramienta}', [HerramientaController::class, 'update'])->name('herramientas.update');
    Route::get('/herramientas/eliminar', [HerramientaController::class, 'eliminate'])->name('herramientas.eliminate');
    Route::delete('/herramientas/{herramienta}', [HerramientaController::class, 'destroy'])->name('herramientas.destroy');
    
    // Rutas para modificar y asignar herramientas
    Route::get('/herramientas/asignar', [HerramientaController::class, 'asignarForm'])->name('herramientas.asignar.form');
    Route::post('/herramientas/asignar', [HerramientaController::class, 'asignar'])->name('herramientas.asignar');
    Route::post('/vehiculos/devolver', [VehiculoController::class, 'devolver'])->name('vehiculos.devolver');
    
    Route::patch('/vehiculos/{vehiculo}/estado', [VehiculoController::class, 'cambiarEstado'])->name('vehiculos.cambiarEstado');

    Route::post('/vehiculos/documentos/subir/{detalle}', [VehiculoDocumentoController::class, 'subir'])->name('vehiculos.documentos.subir');
    Route::get('/vehiculos/documentos/descargar/{documento}', [VehiculoDocumentoController::class, 'descargar'])->name('vehiculos.documentos.descargar');
    Route::get('/vehiculos/documentos/historial/{detalle}', [VehiculoDocumentoController::class, 'historial'])->name('vehiculos.documentos.historial');
    Route::get('/vehiculos/documentos/ver/{documento}', [VehiculoDocumentoController::class, 'ver'])->name('vehiculos.documentos.ver');
    Route::delete('/vehiculos/documentos/{documento}/eliminar', [VehiculoDocumentoController::class, 'eliminar'])->name('vehiculos.documentos.eliminar');

    //-------------------------------------------------------------------------------------------------------------------------
    //Conductores
    Route::get('/conductores', [ConductorController::class, 'index'])->name('conductores.index');

    //Actions
    Route::get('/conductores/agregar', [ConductorController::class, 'create'])->name('conductores.create');
    Route::post('/conductores', [ConductorController::class, 'store'])->name('conductores.store');
    Route::get('/conductores/eliminar', [ConductorController::class, 'eliminate'])->name('conductores.eliminar');
    Route::delete('/conductores/{conductor}', [ConductorController::class, 'destroy'])->name('conductores.destroy');
    Route::get('/conductores/modificar/{conductor}', [ConductorController::class, 'edit'])->name('conductores.edit');
    Route::put('/conductores/modificar/{conductor}', [ConductorController::class, 'update'])->name('conductores.update');
    
    // Rutas para asignación de conductores
    Route::get('/conductores/asignar', [ConductorController::class, 'asignarForm'])->name('conductores.asignar.form');
    Route::post('/conductores/asignar', [ConductorController::class, 'asignar'])->name('conductores.asignar');
    
    //-------------------------------------------------------------------------------------------------------------------------
    //Alertas
    Route::get('/alertas', [AlertasController::class, 'index'])->name('alertas.index');
    
    //-------------------------------------------------------------------------------------------------------------------------
    //Historial
    Route::get('/historial', [\App\Http\Controllers\Modulos\HistorialController::class, 'index'])->name('historial.index');
    Route::get('/historial/eliminar/{item}', function($item) {
        // Puedes pasar el item al view según tu lógica
        return view('modulos.historial.eliminar', compact('item'));
    })->name('historial.eliminar');
    Route::delete('/historial/eliminar/{item}', [HistorialController::class, 'destroy'])->name('historial.destroy');
    Route::get('/historial/mantenimientos/{item}', [HistorialController::class, 'mantenimientos'])->name('historial.mantenimientos');
    Route::get('/historial/editar/{item}', [HistorialController::class, 'editar'])->name('historial.editar');
    Route::get('/historial/herramienta/{id}', [HistorialController::class, 'historialHerramienta'])->name('historial.herramienta');
    Route::get('/historial/vehiculo/{id}', [HistorialController::class, 'historialVehiculo'])->name('historial.vehiculo');

    // Chatbot (Hugging Face) - recibe mensajes desde el widget y responde
    Route::post('/chat', [HuggingFaceChatController::class, 'chat'])->name('chat');
    
    // Test endpoint para debug HF API
    Route::get('/hf-test', [HFTestController::class, 'test'])->name('hf.test');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::post('/auth', [AuthController::class, 'handle'])->name('auth.handle');

Route::get('/password/reset', function () {
    return view('auth.verycontra');
})->name('password.request');

Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');