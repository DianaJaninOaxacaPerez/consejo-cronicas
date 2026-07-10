<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticiaImagen extends Model
{
    protected $table = 'noticias_imagenes';

    protected $primaryKey = 'id_imagen';

    public $timestamps = false;

    protected $fillable = [
        'id_noticia',
        'imagen',
        'orden',
    ];

    public function noticia()
    {
        return $this->belongsTo(Noticia::class, 'id_noticia', 'id_noticia');
    }
}