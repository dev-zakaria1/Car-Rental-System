<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class car_category extends Model
{
    protected $fillable = ['name', 'description'];
    public function car()
    {
        return $this->hasMany(car::class, 'category_id');
    }
    
}
