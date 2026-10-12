<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPersona extends Model
{
    use HasFactory;

    protected $table = 'tipo_personas';
    protected $primaryKey = 'id_tipopersona';
    public $timestamps = true;

    protected $fillable = [
        'descripcion',
    ];

    public function personas()
    {
        return $this->hasMany(Persona::class, 'id_tipopersona', 'id_tipopersona');
    }
}
