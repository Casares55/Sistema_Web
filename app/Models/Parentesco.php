<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parentesco extends Model
{
    use HasFactory;

    protected $table = 'parentescos';
    protected $primaryKey = 'id_parentesco';
    protected $fillable = ['descripcion'];
    public $timestamps = true;

    public function relaciones()
    {
        return $this->hasMany(RelacionPersonal::class, 'id_parentesco', 'id_parentesco');
    }
}
