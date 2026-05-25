<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $fillable = ['booking_id', 'amount', 'currency', 'method', 'status', 'transaction_ref', 'paid_at'];

    public function booking()
    {
        return $this->belongsTo(booking::class);
    }
}
