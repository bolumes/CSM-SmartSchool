<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpacePost extends Model
{
    use HasFactory;

    protected $fillable = [
        'space_id',
        'user_id',
        'content'
    ];

    /**
     * Grupo da mensagem
     */
    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    /**
     * Autor da mensagem
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Comentários da mensagem
     */
    public function comments()
    {
        return $this->hasMany(SpaceComment::class);
    }

    /**
     * Anexos da mensagem
     */
    public function attachments()
    {
        return $this->hasMany(SpacePostAttachment::class);
    }
}
