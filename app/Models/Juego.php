<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    use HasFactory;

    protected $table = 'juegos';
    protected $primaryKey = 'id_juego';
    public $timestamps = false;

    /**
     * The roles that belong to the Juegos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'juegos_has_categorias', 'juegos_id_juego', 'categorias_id_categoria');
    }

    public function plataformas()
    {
        return $this->belongsToMany(Plataforma::class, 'juegos_has_plataformas', 'juegos_id_juego', 'plataformas_id_plataforma');
    }

    /**
     * Get all of the comments for the Juego
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participantes()
    {
        return $this->hasMany(Participar::class, 'id_juego');
    }
}
