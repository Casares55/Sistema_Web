<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapturaImagen extends Model
{
    use HasFactory;

    protected $table = 'captura_imagen';
    protected $primaryKey = 'id_imagen';
    public $timestamps = false;

    protected $fillable = [
        'id_dispositivo',
        'id_registro',
        'ruta_imagen',
        'hash_imagen',
        'fecha_captura'
    ];

    public function embedding()
    {
        return $this->hasOne(Embedding::class, 'id_imagen', 'id_imagen');
    }

    public function registroBiometrico()
    {
        return $this->belongsTo(RegistroBiometrico::class, 'id_registro', 'id_registro');
    }
}
