<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\backend\StaffLeave;

class Staff extends Model
{
    use HasFactory;

    protected $table ="staff";
    protected $fillable = ['name', 'photo', 'position', 'is_available'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function leaves()
{
    return $this->hasMany(StaffLeave::class);
}
}
