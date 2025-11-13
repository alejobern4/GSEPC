<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'id_persona'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tieneFuncion($nombreFuncion)
    {
        foreach ($this->roles as $rol) {
            if ($rol->funciones->contains('funcion', $nombreFuncion)) {
                return true;
            }
        }
        return false;
    }

    public function tieneRol($nombreRol)
    {
        return $this->roles->contains('rol', $nombreRol); // Asume que la columna se llama 'rol'
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function estadoRegistro()
    {
        return $this->belongsTo(EstadoRegistro::class, 'id_estadoregistro');
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'rol_usuarios', 'user_id', 'id_rol');
    }

    public function detalleVehiculos()
    {
        return $this->hasMany(DetalleVehiculo::class, 'user_id');
    }

    public function prestamoHerramientas()
    {
        return $this->hasMany(PrestamoHerramienta::class, 'user_id');
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class, 'user_id');
    }
}
