<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'booking_date',
        'time_slot',
        'client_name',
        'last_name',
        'email',
        'phone',
        'address',
        'suburb',
        'postcode',
        'price',
        'total_price',
    ];


    // Cast the date fields to Carbon instances
    protected $casts = [
        'booking_date' => 'date',
        'price' => 'float',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
