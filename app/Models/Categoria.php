<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;

     /**
     * The roles that belong to the Juegos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function juegos()
    {
        return $this->belongsToMany(Juego::class, 'juegos_has_categorias', 'id_categoria', 'id_juego');
    }
}
