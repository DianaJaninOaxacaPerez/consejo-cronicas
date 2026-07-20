<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroEvento extends Model
{
    protected $table = 'registros_evento';
    protected $primaryKey = 'id_registro';
    public $timestamps = false;
    protected $fillable = ['nombre', 'telefono', 'id_mesa', 'fecha_registro'];

    public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'id_mesa', 'id_mesa');
    }
}