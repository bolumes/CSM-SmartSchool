<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;

    protected $table = 'eleves';

    protected $fillable = [
    'classe_id',
    'matricula',
    'nome',
    'apelido',
    'data_nascimento',
    'endereco',
    'telefone',
    ];

    /*
    |-----------------------------------
    | RELAÇÃO: Eleve → Classe
    |-----------------------------------
    */
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    /*
    |-----------------------------------
    | RELAÇÃO: Eleve → Notes
    |-----------------------------------
    */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}