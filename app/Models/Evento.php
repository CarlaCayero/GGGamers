<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';
    protected $primaryKey = 'id_evento';
    public $timestamps = false;

    /**
     * Relación con Espacio
     */
    public function espacio()
    {
        return $this->belongsTo(Espacio::class, 'espacios_id_espacio');
    }

    /**
     * Relación muchos a muchos con usuarios
     */
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'evento_usuario', 'evento_id_evento', 'usuario_id_usuario')
            ->withPivot('posicion');  // Incluye la columna 'posicion' en la tabla pivot
    }

    /**
     * Relación con Juego
     */
    public function juegos()
    {
        return $this->belongsTo(Juego::class, 'juegos_id_juego');
    }
}
