<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    /**
     * Get the user that owns the Usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
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
