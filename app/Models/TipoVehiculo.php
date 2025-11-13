<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{
    protected $table = 'tipo_vehiculos';

    public $timestamps = true;

    protected $fillable = [
        'tipo_vehiculo',
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'id_tipovehiculo');
    }
}
