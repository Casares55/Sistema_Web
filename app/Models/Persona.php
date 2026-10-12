<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'id_persona';
    protected $fillable = ['id_tipopersona','nombre','apellido_paterno','apellido_materno','telefono','correo','direccion','estado'];

    public function registros()
    {
        return $this->hasMany(RegistroBiometrico::class,'id_persona','id_persona');
    }

    public function tipoPersona()
    {
        return $this->belongsTo(TipoPersona::class, 'id_tipopersona', 'id_tipopersona');
    }


    public function registrosBiometricos()
    {
        return $this->hasMany(RegistroBiometrico::class, 'id_persona', 'id_persona');
    }

    /**
     * Relación con Embeddings (a través de Registro y Captura)
     */
    public function embeddings()
    {
        return $this->hasManyThrough(
            Embedding::class,
            CapturaImagen::class,
            'id_registro',               // Foreign key en CAPTURA_IMAGEN
            'id_imagen',                 // Foreign key en EMBEDDING
            'id_persona',                // Local key en PERSONAS
            'id_imagen'                  // Local key en CAPTURA_IMAGEN
        )->join('registro_biometrico', 'registro_biometrico.id_registro', '=', 'captura_imagen.id_registro')
            ->whereColumn('registro_biometrico.id_persona', 'personas.id_persona');
    }

    public function relacionesComoTutor()
    {
        return $this->hasMany(RelacionPersonal::class, 'id_tutor', 'id_persona');
    }

    public function relacionesComoNino()
    {
        return $this->hasMany(RelacionPersonal::class, 'id_nino', 'id_persona');
    }

}
