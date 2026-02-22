<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $fillable = [
        'date',
        'titre',
        'description',
        'fichier',
    ];
}
