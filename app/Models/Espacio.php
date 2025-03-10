<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espacio extends Model
{
    use HasFactory;

    protected $table = 'espacios';
    protected $primaryKey = 'id_espacio';
    public $timestamps = false;

    /**
     * Get all of the comments for the Espacio
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventos()
    {
        return $this->hasMany(Evento::class, 'id_espacio');
    }
}
