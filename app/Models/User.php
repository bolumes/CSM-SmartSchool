<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'telephone',
        'address',
        'function',
        'email',
        'password',
    ];

    /**
     * Os atributos que devem ser ocultos para arrays/JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Os atributos que devem ser convertidos para tipos nativos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


        /* =======================
     |  RELAÇÕES COM SPACES
     ======================= */

    // Spaces criados pelo usuário (professor / direção)
    public function spaces()
    {
        return $this->hasMany(Space::class, 'created_by');
    }

    // Posts criados pelo usuário
    public function spacePosts()
    {
        return $this->hasMany(SpacePost::class);
    }

    // Comentários criados pelo usuário
    public function spaceComments()
    {
        return $this->hasMany(SpaceComment::class);
    }

    /* =======================
     |  PERMISSÕES SIMPLES
     ======================= */

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

}

