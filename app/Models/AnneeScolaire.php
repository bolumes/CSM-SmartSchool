<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeScolaire extends Model
{
    use HasFactory;

    protected $table = 'annees_scolaires';

    protected $fillable = [
        'nome',
        'data_inicio',
        'data_fim',
        'ativo',
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
        'ativo' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relação: Ano Escolar → Inscrições
    |--------------------------------------------------------------------------
    */

    public function inscriptions()
    {
        return $this->hasMany(
            Inscription::class,
            'annee_scolaire_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Verificar se é o ano letivo ativo
    |--------------------------------------------------------------------------
    */

    public function isActive(): bool
    {
        return $this->ativo === true;
    }
}