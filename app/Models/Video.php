<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';
    protected $primaryKey = 'id_video';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'descripcion',
        'categoria',
        'tipo',
        'plataforma',
        'url',
        'archivo',
        'miniatura',
        'duracion',
        'autor',
    ];

    const CATEGORIAS = [
        'tradiciones'  => 'Tradiciones',
        'arquitectura' => 'Arquitectura',
        'arte'         => 'Arte y Pintura',
        'gastronomia'  => 'Gastronomía',
        'artesanias'   => 'Artesanías',
        'naturaleza'   => 'Naturaleza',
        'fiestas'      => 'Fiestas y Eventos',
    ];

    const PLATAFORMAS = [
        'youtube'   => 'YouTube',
        'facebook'  => 'Facebook',
        'tiktok'    => 'TikTok',
        'instagram' => 'Instagram',
        'otro'      => 'Otro',
    ];
}