<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    protected $table = 'entrevistas';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'subtitulo',
        'contenido',
        'imagen',
        'fecha_registro',
    ];

    protected $casts = [
        'fecha_registro' => 'date',
    ];
}