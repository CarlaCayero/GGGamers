<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plataforma extends Model
{
    use HasFactory;

    protected $table = 'plataformas';
    protected $primaryKey = 'id_plataforma';
    public $timestamps = false;

    /**
     * The roles that belong to the Juegos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function juego()
    {
        return $this->belongsToMany(Juego::class, 'juegos_has_plataformas', 'plataformas_id_plataforma','juegos_id_juego');
    }
}
