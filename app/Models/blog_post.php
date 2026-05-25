<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class blog_post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'author_id',
        'published_at',
        'is_published',
        'image',
    ];
    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
