<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpacePostAttachment extends Model
{
    protected $fillable = [
        'space_post_id',
        'file_path',
        'file_name',
        'file_type',
        'file_size'
    ];

    public function post()
    {
        return $this->belongsTo(SpacePost::class);
    }
}
