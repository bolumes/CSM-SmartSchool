<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $fillable = [
        'logged_in_at',
        'ip_address',
        'fonction',
    ];

}
