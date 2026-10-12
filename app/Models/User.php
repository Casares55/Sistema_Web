<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // === Configuración básica ===
    protected $table = 'users'; // tabla usada
    protected $primaryKey = 'id'; // PK por defecto
    public $timestamps = true; // usa created_at y updated_at

    // === Campos asignables en masa ===
    protected $fillable = [
        'nombre',
        'ap',
        'am',
        'email',
        'password',
        'rol_id',
        'estado',
        'ultimo_login',
        'fecha_creacion',
    ];

    // === Campos ocultos (por seguridad) ===
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // === Conversiones automáticas ===
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'ultimo_login' => 'datetime',
            'estado' => 'boolean',
            'password' => 'hashed', // Laravel 11+ usa 'hashed' para Hash::make automático
        ];
    }

    // === Relaciones ===
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id', 'id_rol');
    }
    public function esAdmin(): bool
    {
        return optional($this->rol)->descripcion === 'admin';
    }

    public function esDocente(): bool
    {
        return optional($this->rol)->descripcion === 'docente';
    }

    public function esTutor(): bool
    {
        return optional($this->rol)->descripcion === 'tutor';
    }


    // === Accesor para nombre completo (útil para dashboards) ===
    protected function nombreCompleto(): Attribute
    {
        return Attribute::make(
            get: fn () => trim("{$this->nombre} {$this->ap} {$this->am}")
        );
    }

    // === Actualizar último login fácilmente ===
    public function actualizarUltimoLogin(): void
    {
        $this->update(['ultimo_login' => now()]);
    }

}
