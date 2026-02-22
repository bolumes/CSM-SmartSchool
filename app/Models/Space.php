<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'created_by',
    ];

    // Criador do espaço
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Posts do espaço
    public function posts()
    {
        return $this->hasMany(SpacePost::class);
    }

    // Usuários do espaço (muitos-para-muitos)
    public function users()
    {
        return $this->belongsToMany(User::class, 'space_user')
                    ->withTimestamps();
    }

    public function messages()
    {
        return $this->posts();
    }
}
