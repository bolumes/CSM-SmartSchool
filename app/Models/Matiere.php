<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    /** @use HasFactory<\Database\Factories\MatiereFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'level',
        'description',
    ];
    protected $table = 'matieres'; // <- GARANTE que o Laravel use o nome certo

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'classe_matiere');
    }
}
