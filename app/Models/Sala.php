<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    /** @use HasFactory<\Database\Factories\SalaFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'reservar',
        'categoria',
        'capacidade',
        'edificio_id', // Adicionando a chave estrangeira
        'caracteristicas',
        'localizacao',  
        'imagem',
    ];
}
