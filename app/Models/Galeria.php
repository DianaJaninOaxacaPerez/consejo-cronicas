<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Galeria extends Model
{
    protected $table = 'galeria';
    protected $primaryKey = 'id_galeria';
    public $timestamps = false;
    protected $fillable = [
        'titulo',
        'descripcion',
        'ruta_imagen',
        'categoria',
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
}