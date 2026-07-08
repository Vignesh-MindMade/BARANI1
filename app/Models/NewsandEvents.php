<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class NewsandEvents extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $fillable = ['image',
    'event_date',
    'title',
    'heading',
    'description',
    'image1',
    'content1',
    'image2',
    'content2',
    'image3',
    'content3',
    'image4',
    'content4',
    'image5',
    'content5',
    'image6',
    'content6',
    'image7',
    'content7',
    'image8',
    'content8',
    'sort_id'];
    
    public function getEventDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

}
