<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class testimonial extends Model
{
    protected $fillable = ['user_name', 'user_title', 'avatar_url', 'content', 'rating', 'is_visible'];
    protected $casts = [
        'is_visible' => 'boolean',
    ];
}
