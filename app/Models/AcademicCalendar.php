<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AcademicCalendar extends Model
{
    use HasFactory;

    protected $table = 'academic_calendar';
    protected $fillable = ['event','date'];
    
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

}
