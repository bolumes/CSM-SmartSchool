<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progevent extends Model
{
    protected $table = 'progevents'; // Nom de la table associée au modèle

    protected $fillable = [
        'date',
        'start',
        'end',
        'sala_id',
        'event_id',
    ];

    public function sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
