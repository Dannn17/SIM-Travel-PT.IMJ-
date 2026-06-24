<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 
        'identity_number', 
        'phone', 
        'age', 
        'occupation', 
        'address', 
        'domicile', 
        'guarantor', 
        'source', 
        'guarantee', 
        'track_record', 
        'classification_result'
    ];

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
