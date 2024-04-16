<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsandEvents extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $fillable = ['image','event_date','description', 'sort_id'];

}
