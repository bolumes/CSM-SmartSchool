<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Message;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'firstname',
        'lastname',
        'telephone',
        'address',
        'function',
        'email',
        'password',
        'classe_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /* =====================================================
     | RELAÇÕES COM ELEVE
     ===================================================== */

    /**
     * Perfil escolar deste utilizador quando é aluno.
     */
    public function eleve()
    {
        return $this->hasOne(
            Eleve::class,
            'user_id'
        );
    }


    /**
     * Alunos associados a este utilizador quando é encarregado.
     *
     * Um encarregado pode ter vários alunos.
     */
    public function enfants()
    {
        return $this->hasMany(
            Eleve::class,
            'parent_id'
        );
    }


    /* =====================================================
     | RELAÇÃO COM CLASSE
     ===================================================== */

    /**
     * Classe associada ao utilizador.
     */
    public function classe()
    {
        return $this->belongsTo(
            Classe::class
        );
    }


    /* =====================================================
     | RELAÇÕES COM SPACES
     ===================================================== */

    public function spaces()
    {
        return $this->hasMany(
            Space::class,
            'created_by'
        );
    }

    public function spacePosts()
    {
        return $this->hasMany(
            SpacePost::class
        );
    }

    public function spaceComments()
    {
        return $this->hasMany(
            SpaceComment::class
        );
    }


    /* =====================================================
     | PERMISSÕES
     ===================================================== */

    public function isProfessor()
    {
        return $this->function === 'professor';
    }

    public function isParent()
    {
        return $this->function === 'parent';
    }

    public function isDirection()
    {
        return $this->function === 'direction';
    }

    public function isAdmin()
    {
        return $this->function === 'admin';
    }

    public function isEleve()
    {
        return $this->function === 'eleve';
    }


    /* =====================================================
     | MENSAGENS
     ===================================================== */

    public function sentMessages()
    {
        return $this->hasMany(
            Message::class,
            'sender_id'
        );
    }

    public function receivedMessages()
    {
        return $this->hasMany(
            Message::class,
            'receiver_id'
        );
    }
}