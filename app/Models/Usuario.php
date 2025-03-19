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

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rols_id');
    }

    /**
     * Get all of the comments for the Juego
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participantes()
    {
        return $this->hasMany(Participar::class, 'id_usuario');
    }
}
