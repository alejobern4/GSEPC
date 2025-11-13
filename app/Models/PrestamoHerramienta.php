<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestamoHerramienta extends Model
{
    protected $table = 'prestamo_herramientas';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'id_herramienta',
        'fecha_solicitud',
        'fecha_devolucion',
        'persona_asignada',
    ];

    public function herramienta()
    {
        return $this->belongsTo(Herramienta::class, 'id_herramienta');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
