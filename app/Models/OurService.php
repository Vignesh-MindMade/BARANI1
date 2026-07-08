<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurService extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'points_title',
        'point_1',
        'point_2',
        'point_3',
        'point_4',
        'point_5',
        'point_6',
        'readmore_link',
    ];

    protected $table = 'our_service';

}
