<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDispositivo extends Model
{
    use HasFactory;

    protected $table = 'tipo_dispositivos';
    protected $primaryKey = 'id_tipodispositivo';
    public $timestamps = true;

    protected $fillable = [
        'descripcion',
    ];

    public function dispositivos()
    {
        return $this->hasMany(Dispositivo::class, 'id_tipodispositivo', 'id_tipodispositivo');
    }
}
