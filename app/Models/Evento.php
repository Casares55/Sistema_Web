<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';
    protected $primaryKey = 'id_evento';
    public $timestamps = false;

    protected $fillable = [
        'id_persona',
        'id_dispositivo',
        'id_embedding',
        'id_tipoevento',
        'fecha_evento',
        'confianza',
        'resultado',
    ];

    protected $casts = [
        'fecha_evento' => 'datetime',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona', 'id_persona');
    }

    public function dispositivo()
    {
        return $this->belongsTo(Dispositivo::class, 'id_dispositivo', 'id_dispositivo');
    }


    public function tipoEvento()
    {
        return $this->belongsTo(TipoEvento::class, 'id_tipoevento', 'id_tipoevento');
    }
}
