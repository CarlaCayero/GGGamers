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
    public function plataformas()
    {
        return $this->belongsToMany(Plataforma::class, 'juegos_has_plataformas', 'id_juego', 'id_plataforma');
    }

    /**
     * The roles that belong to the Juegos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'juegos_has_categorias', 'id_juego', 'id_categoria');
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
