<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Embedding extends Model
{
    use HasFactory;

    protected $table = 'embeddings';
    protected $primaryKey = 'id_embedding';
    public $timestamps = false;

    protected $fillable = [
        'id_imagen',
        'vector_embedding',
        'fecha_creacion'
    ];

    /**
     * Relación con la imagen de la que proviene.
     */
    public function capturaImagen()
    {
        return $this->belongsTo(CapturaImagen::class, 'id_imagen', 'id_imagen');
    }

    /**
     * Mutador: convierte array a JSON antes de guardar.
     */
    public function setVectorEmbeddingAttribute($value)
    {
        $this->attributes['vector_embedding'] = json_encode($value);
    }

    /**
     * Accesor: convierte JSON a array al leerlo.
     */
    public function getVectorEmbeddingAttribute($value)
    {
        return json_decode($value, true);
    }
}
