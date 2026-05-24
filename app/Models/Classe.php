<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    /** @use HasFactory<\Database\Factories\ClasseFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'level',
        'description',
    ];

    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }   

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'classe_matiere');
    }


}
