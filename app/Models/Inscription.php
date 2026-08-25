<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscription extends Model
{
    use HasFactory;

    protected $table = 'inscriptions';

    protected $fillable = [
        'eleve_id',
        'classe_id',
        'annee_scolaire_id',
        'data_inscricao',
        'validada',
        'data_validacao',
    ];

    protected $casts = [
        'data_inscricao' => 'date',
        'data_validacao' => 'datetime',
        'validada' => 'boolean',
    ];

    public function eleve(): BelongsTo
    {
        return $this->belongsTo(
            Eleve::class,
            'eleve_id'
        );
    }

    public function classe(): BelongsTo
    {
        return $this->belongsTo(
            Classe::class,
            'classe_id'
        );
    }

    public function anneeScolaire(): BelongsTo
    {
        return $this->belongsTo(
            AnneeScolaire::class,
            'annee_scolaire_id'
        );
    }
}