<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;

    protected $table = 'eleves';

    protected $fillable = [
        'matricula',
        'parent_id',
        'nome',
        'apelido',
        'data_nascimento',
        'sexo',
        'endereco',
        'telefone',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];


    /*
    |--------------------------------------------------------------------------
    | Encarregado de educação
    |--------------------------------------------------------------------------
    */

    public function parent()
    {
        return $this->belongsTo(
            User::class,
            'parent_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Inscrições
    |--------------------------------------------------------------------------
    */

    public function inscriptions()
    {
        return $this->hasMany(
            Inscription::class,
            'eleve_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Notas
    |--------------------------------------------------------------------------
    */

    public function notes()
    {
        return $this->hasMany(
            Note::class,
            'eleve_id'
        );
    }
}