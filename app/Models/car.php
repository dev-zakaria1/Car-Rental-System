<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class car extends Model
{
    protected $fillable = [
        'category_id',
        'location_id',
        'make',
        'model',
        'year',
        'registration_no',
        'vin',
        'transmission',
        'fuel_type',
        'doors',
        'seats',
        'luggage',
        'color',
        'hour_rate',
        'image_url',
        'status',
    ];

    public function car_category()
    {
        return $this->belongsTo(car_category::class, 'category_id');
    }
    public function location()
    {
        return $this->belongsTo(location::class, 'location_id');
    }
    public function bookings()
    {
        return $this->hasMany(booking::class, 'car_id');
    }
    public function scopeSearchType(Builder $query, $dataSearch)
    {
        if ($dataSearch['type'])
            return $query->where('category_id', $dataSearch['type']);
        return $query;
    }
    public function scopeAvailable(Builder $query, $dataSearch)
    {
        if ($dataSearch['type'] && !$dataSearch['pick_up'] && !$dataSearch['drop_off']) {
            return $query->where('category_id', $dataSearch['type'])->where('status','available');
        }
        if ($dataSearch['type'] && $dataSearch['pick_up'] && $dataSearch['drop_off']) {
            $categoryId = $dataSearch['type'];
            $pickup = $dataSearch['pick_up'];
            $dropoff = $dataSearch['drop_off'];
            return $query->where('category_id', $categoryId)->where('status','available')
                ->whereDoesntHave('bookings', function ($q) use ($pickup, $dropoff) {
                    $q->where(function ($statusQuery) {
                        $statusQuery->whereIn('status', ['confirmed', 'in_progress'])
                            ->orWhere(function ($pendingQuery) {
                                $pendingQuery->where('status', 'pending')
                                    ->where('created_at', '>=', now()->subMinutes(30));
                            });
                    })
                        ->where(function ($timeQuery) use ($pickup, $dropoff) {
                            $timeQuery->whereBetween('pickup_datetime', [$pickup, $dropoff])
                                ->orWhereBetween('dropoff_datetime', [$pickup, $dropoff])
                                ->orWhere(function ($overlapQuery) use ($pickup, $dropoff) {
                                    $overlapQuery->where('pickup_datetime', '<=', $pickup)
                                        ->where('dropoff_datetime', '>=', $dropoff);
                                });
                        });
                });
        }
        return $query;
    }
}
