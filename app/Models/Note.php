<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $fillable = [
        'eleve_id',
        'matiere_id',
        'professor_id',
        'nota',
        'trimestre',
        'ano_letivo',
        'observacao',
    ];

    /**
     * Relacionamento com a tabela eleves (aluno)
     */
    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }

    /**
     * Relacionamento com a tabela matieres (disciplina)
     */
    public function materia()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id');
    }

    /**
     * Relacionamento com a tabela professors (professor que lançou a nota)
     */
    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }
}