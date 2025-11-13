<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoRegistro extends Model
{
    use HasFactory;

    protected $table = 'estado_registros';

    public $timestamps = true;

    protected $fillable = [
        'estado_registro',
    ];

    public function usuarios()
    {
        return $this->hasMany(User::class, 'id_estadoregistro');
    }

    public function herramientas()
    {
        return $this->hasMany(Herramienta::class, 'id_estadoregistro');
    }

    public function detalleVehiculos()
    {
        return $this->hasMany(DetalleVehiculo::class, 'id_estadoregistro');
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class, 'id_estadoregistro');
    }
}
