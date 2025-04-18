<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventsFactory> */
    use HasFactory;
    protected $fillable = [
        'type',
        'matiere_id',
        'professor_id',
    ];

    // Relacionamento com Matiere
    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id');
    }

    // Relacionamento com Professor
    public function professor()
    {
        return $this->belongsTo(Professor::class, 'professor_id');
    }

    public function progevents()
    {
        return $this->hasMany(Progevent::class);
    }
}
