<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RegistroBiometrico extends Model
{
    protected $table = 'registro_biometrico';
    protected $primaryKey = 'id_registro';
    protected $fillable = ['id_usuario','id_persona','etiqueta_registro','activo'];

    public function persona()
    {
        return $this->belongsTo(Persona::class,'id_persona','id_persona');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class,'id_usuario','id');
    }

    public function capturas()
    {
        return $this->hasMany(CapturaImagen::class,'id_registro','id_registro');
    }
}
