<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';

    public $timestamps = true;

    protected $fillable = [
        'modelo_vehiculo',
        'marca_vehiculo',
        'id_tipovehiculo',
        'anio',
        'nombre',
    ];

    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, 'id_tipovehiculo');
    }

    public function detalleVehiculo()
    {
        return $this->hasMany(DetalleVehiculo::class, 'id_vehiculo');
    }
}
