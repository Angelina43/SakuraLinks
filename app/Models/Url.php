<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $table = 'url';

    protected $fillable = [
        'name_url',
        'short_url',
    ];
}
