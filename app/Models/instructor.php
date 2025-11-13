<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class instructor extends Model
{
    protected $fillable = [
        'image',
        'sosmed',
        'nama',
        'jurusan',
        'sosmed_urls'
    ];
    protected $casts = [
        'sosmed' => 'array',
        'sosmed_urls' => 'array',
    ];
}
