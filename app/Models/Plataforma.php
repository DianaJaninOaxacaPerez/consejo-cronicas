<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plataforma extends Model
{
    protected $table = 'plataformas';
    protected $primaryKey = 'id_plataforma';

    protected $fillable = [
        'nombre',
        'foto',
        'youtube_url',
        'facebook_url',
    ];
}