<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención plural)
    protected $table = 'ubicaciones';

    // Nombre de la PK, porque no es el 'id' por defecto
    protected $primaryKey = 'id_ubicacion';

    // Si la PK no es autoincrement o no es integer, habría que indicarlo
    public $incrementing = true; // ya que usamos $table->id()
    protected $keyType = 'int';

    // Para manejar created_at y updated_at
    public $timestamps = true;

    // Campos que se pueden asignar en masa
    protected $fillable = [
        'descripcion',
    ];

    // Relación: una ubicación tiene muchos dispositivos
    public function dispositivos()
    {
        return $this->hasMany(Dispositivo::class, 'id_ubicacion', 'id_ubicacion');
    }
}
