<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RelacionPersonal extends Model
{
    use HasFactory;

    protected $table = 'relaciones_personales';
    protected $primaryKey = 'id_relacion';
    protected $fillable = [
        'id_tutor',
        'id_nino',
        'id_parentesco',
        'estado_validacion',
        'fecha_registro',
        'fecha_validacion',
        'observaciones'
    ];
    public $timestamps = true;

    public function tutor()
    {
        return $this->belongsTo(Persona::class, 'id_tutor', 'id_persona');
    }

    public function nino()
    {
        return $this->belongsTo(Persona::class, 'id_nino', 'id_persona');
    }

    public function parentesco()
    {
        return $this->belongsTo(Parentesco::class, 'id_parentesco', 'id_parentesco');
    }
}
