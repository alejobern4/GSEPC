<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'rols';

    public $timestamps = true;

    protected $fillable = [
        'rol',
        'descripcion',
    ];

    public function funciones()
    {
        return $this->belongsToMany(Funcion::class, 'rol_funcions', 'id_rol', 'id_funcion');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'rol_usuarios', 'id_rol', 'user_id');
    }
}
