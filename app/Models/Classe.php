<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'level',
        'description',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relação: Classe → Eleves
    |--------------------------------------------------------------------------
    */
    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Relação: Classe → Inscriptions
    |--------------------------------------------------------------------------
    */
    public function inscriptions(): HasMany
    {
        return $this->hasMany(Inscription::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Relação: Classe → Matieres
    |--------------------------------------------------------------------------
    */
    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'classe_matiere');
    }
}