<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAlerta extends Model
{
    protected $table = 'tipo_alertas';

    public $timestamps = true;

    protected $fillable = [
        'tipo_alerta',
        'descripcion',
    ];
    public function alertas()
    {
        return $this->hasMany(Alerta::class, 'id_tipoalerta');
    }
}
