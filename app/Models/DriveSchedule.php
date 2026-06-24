<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriveSchedule extends Model
{
    protected $fillable = [
        'driver_id',
        'booking_id',
        'honor',
        'kedatangan',
        'denda',
        'status',
    ];
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
