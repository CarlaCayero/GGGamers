<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    use HasFactory;

    protected $table = 'eventos';
    protected $primaryKey = 'id_evento';
    public $timestamps = false;

    /**
     * Get the user that owns the Evento
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function espacio()
    {
        return $this->belongsTo(Espacio::class, 'id_espacio');
    }

    /**
     * Get all of the comments for the Juego
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participantes()
    {
        return $this->hasMany(Participar::class, 'id_evento');
    }

}
