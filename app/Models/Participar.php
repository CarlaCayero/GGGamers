<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participar extends Model
{
    use HasFactory;

    protected $table = 'usuarios_has_eventos';
    protected $primaryKey = ['id_evento', 'id_usuario'];
    public $timestamps = false;


}
