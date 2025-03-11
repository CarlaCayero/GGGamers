<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Evento;

class Participar extends Model
{
    use HasFactory;

    protected $table = 'usuarios_has_eventos';
    public $timestamps = false;
    public $incrementing = false;

    /**
     * Get the user that owns the Participar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    /**
     * Get the user that owns the Participar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento');
    }

    /**
     * Get the user that owns the Participar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function juego()
    {
        return $this->belongsTo(Juego::class, 'id_juego');
    }


}
