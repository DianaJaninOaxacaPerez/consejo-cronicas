<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';
    protected $primaryKey = 'id_noticia';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'contenido',
        'imagen',
        'fecha_publicacion',
        'categoria',
        'id_usuario',
    ];

    protected $casts = [
        'fecha_publicacion' => 'date',
    ];

    public function imagenesGaleria()
    {
        return $this->hasMany(NoticiaImagen::class, 'id_noticia', 'id_noticia');
    }
}