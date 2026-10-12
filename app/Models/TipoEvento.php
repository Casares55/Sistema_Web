<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEvento extends Model
{
    protected $table = 'tipo_eventos';
    protected $primaryKey = 'id_tipoevento';
    public $timestamps = false;

    protected $fillable = ['descripcion'];

    public function eventos()
    {
        return $this->hasMany(Evento::class, 'id_tipoevento', 'id_tipoevento');
    }
}
