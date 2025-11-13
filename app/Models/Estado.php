<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estados';
    public $timestamps = true;

    protected $fillable = [
        'estado',
        'descripcion',
    ];

    public function detalleVehiculos()
    {
        return $this->hasMany(DetalleVehiculo::class, 'id_estado');
    }

    public function herramientas()
    {
        return $this->hasMany(Herramienta::class, 'id_estado');
    }
}
