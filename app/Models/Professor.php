<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    /** @use HasFactory<\Database\Factories\ProfessorFactory> */
    use HasFactory;


    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'telephone',
        'address',
    ];

    protected $table = 'professors'; // <- GARANTE que o Laravel use o nome certo

    public function events()
    {
        return $this->hasMany(Event::class);
    }

}
