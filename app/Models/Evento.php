<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $primaryKey = 'id_evento';
    use HasFactory;
    protected $fillable = [
        'nombre_evento', 'fecha', 'hora', 'lugar', 'tipo_evento', 'id_org', 'id_fotog'
    ];
}
