<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuracion';
    public $timestamps = false;

    protected $fillable = [
        'logo',
        'correo',
        'telefono',
        'ubicacion',
        'facebook',
        'instagram',
        'tiktok',
        'youtube',
    ];
}