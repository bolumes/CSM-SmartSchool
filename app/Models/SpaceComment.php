<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpaceComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'space_post_id',
        'user_id',
        'content'
    ];

    /**
     * Post ao qual pertence
     */
    public function post()
    {
        return $this->belongsTo(SpacePost::class, 'space_post_id');
    }

    /**
     * Autor do comentário
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
