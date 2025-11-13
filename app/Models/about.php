<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class about extends Model
{
    protected $fillable = ['image', 'title', 'description','feature'];
    protected $casts = ['feature' => 'array'];
}
