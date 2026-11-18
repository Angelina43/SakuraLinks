<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserUrl extends Model
{
    protected $table = 'user_url';
    protected $fillable = [
        'user_id',
        'url_id'
    ];
}
