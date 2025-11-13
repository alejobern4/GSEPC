<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    use HasFactory;

    protected $table = 'alertas';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'id_detallevehiculo',
        'email_alerta',
        'id_tipoalerta',
        'id_estadoregistro',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detalleVehiculo()
    {
        return $this->belongsTo(DetalleVehiculo::class, 'id_detallevehiculo');
    }

    public function estadoRegistro()
    {
        return $this->belongsTo(EstadoRegistro::class, 'id_estadoregistro');
    }

    public function tipoAlerta()
    {
        return $this->belongsTo(TipoAlerta::class, 'id_tipoalerta');
    }
}
