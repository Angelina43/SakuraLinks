<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserUrl extends Model
{
    protected $table = 'user_urls';
    protected $fillable = [
        'user_id',
        'url_id'
    ];

    public function url()
    {
        return $this->belongsTo(Url::class, 'url_id');
    }
}
