<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'message'];
    protected $casts = [
        'is_read' => 'boolean',
    ];
}
