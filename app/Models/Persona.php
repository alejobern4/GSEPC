<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'num_documento',
        'id_tipdocumento'
    ];

    public function tipoDocumento()
    {
        return $this->belongsTo(\App\Models\TipoDocumento::class, 'id_tipdocumento');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_persona');
    }

    // Accesor para el nombre completo
    public function getNombreCompletoAttribute()
    {
        return trim(
            "{$this->primer_nombre} {$this->segundo_nombre} {$this->primer_apellido} {$this->segundo_apellido}"
        );
    }
}