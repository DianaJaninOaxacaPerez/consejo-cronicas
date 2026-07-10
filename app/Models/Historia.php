<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    protected $table = 'historias';

    protected $primaryKey = 'id_historia';

    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'fecha_creacion',
        'fecha_actualizacion',
    ];

    protected $casts = [
        'fecha_creacion' => 'datetime',
        'fecha_actualizacion' => 'datetime',
    ];
}