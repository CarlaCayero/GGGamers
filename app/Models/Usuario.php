<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;


    protected $fillable = [
        'nombre',
        'edad',
        'contraseña',
        'imagen',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'roles_id_rol');
    }

    /**
     * Get all of the comments for the Juego
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'evento_usuario', 'usuario_id_usuario', 'evento_id_evento')
            ->withPivot('posicion');  // Esto incluye la columna 'posicion' de la tabla pivot
    }
}
