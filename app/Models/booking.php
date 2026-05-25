<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class booking extends Model
{
    protected $fillable = [
        'car_id',
        'pickup_location_id',
        'dropoff_location_id',
        'pickup_datetime',
        'dropoff_datetime',
        'status',
        'notes'
    ];
    protected $hidden = ['user_id', 'total_price'];
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function car()
    {
        return $this->belongsTo(car::class, 'car_id');
    }
    public function pickup_location()
    {
        return $this->belongsTo(location::class, 'pickup_location_id');
    }
    public function dropoff_location()
    {
        return $this->belongsTo(location::class, 'dropoff_location_id');
    }
    public function payment()
    {
        return $this->hasOne(payment::class);
    }
    
}
