<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    protected $table = 'dispositivos';
    protected $primaryKey = 'id_dispositivo';
    public $timestamps = false;

    protected $fillable = [
        'codigo_interno',
        'descripcion',
        'id_ubicacion',
        'direccion_ip',
        'id_tipodispositivo',
        'estatus',
        'fecha_creacion'
    ];

    protected $casts = [
        'fecha_creacion' => 'datetime',
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion', 'id_ubicacion');
    }

    public function tipoDispositivo()
    {
        return $this->belongsTo(TipoDispositivo::class, 'id_tipodispositivo', 'id_tipodispositivo');
    }
}
