<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehiculoDocumento extends Model
{
    protected $table = 'vehiculo_documentos';

    public $timestamps = true;

    protected $fillable = [
        'id_detallevehiculo',
        'nombre',
        'fecha',
        'ruta',
    ];

    public function vehiculoDetalle()
    {
        return $this->belongsTo(DetalleVehiculo::class, 'id_detallevehiculo');
    }
}

