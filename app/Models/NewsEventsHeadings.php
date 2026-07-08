<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsEventsHeadings extends Model
{
    use HasFactory;

    protected $table = 'events_heading';
    protected $fillable = ['heading'];
    
}
