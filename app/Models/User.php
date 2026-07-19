<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuario';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'correo',
        'password_hash',
        'id_rol',
        'estado',
        'cargo',
    ];

    protected $hidden = [
        'password_hash',
    ];

    // Laravel usa "password" internamente; le decimos que en realidad
    // debe leer la columna "password_hash"
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function getNameAttribute()
    {
        return $this->nombre;
    }

    public function getEmailAttribute()
    {
        return $this->correo;
    }

    public function initials(): string
    {
        return \Illuminate\Support\Str::of($this->nombre)
            ->explode(' ')
            ->map(fn ($palabra) => \Illuminate\Support\Str::substr($palabra, 0, 1))
            ->implode('');
    }

    // Le decimos a Laravel que el "email" para login es el campo "correo"
    public function username()
    {
        return 'correo';
    }

    // Relación: cada usuario pertenece a un rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }
}