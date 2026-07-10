<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cronica extends Model
{
    protected $table = 'cronicas';
    //El pk no se llama "id" sino "id_cronica"
    protected $primaryKey = 'id_cronica';
    //la tabla no tiene created_at/
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'autor',
        'fecha',
        'resumen',
        'contenido',
        'imagen',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];
}