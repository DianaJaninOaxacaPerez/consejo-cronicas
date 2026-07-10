<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cronista extends Model
{
    protected $table = 'cronistas';
    protected $primaryKey = 'id_cronista';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'paterno',
        'materno',
        'cargo',
        'foto',
        'biografia',
        'correo',
        'telefono',
        'fecha_registro',
        'fecha_actualizacion',
    ];

    public function getNombreCompletoAttribute(): string
    {
        return trim("{$this->nombre} {$this->paterno} {$this->materno}");
    }
}