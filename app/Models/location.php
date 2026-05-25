<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class location extends Model
{
    protected $fillable = [
        'name',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'country',
        'postal_code',
        'phone'
    ];
    public function car()
    {
        return $this->hasMany(car::class, 'location_id');
    }
    public function booking_pickup(){
        return $this->hasMany(booking::class,'pickup_location_id');
    }
    public function booking_dropoff(){
        return $this->hasMany(booking::class,'dropoff_location_id');
    }
    
}
