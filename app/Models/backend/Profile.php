<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table ="profiles";
   protected $fillable = [
    'banner_image', 'about_us_description', 'textile_name', 'textile_work', 'textile_description',
    'food_processing_name', 'food_processing_work', 'food_processing_description',
    'history_image', 'history_description', 'management_image', 'mission_description',
    'team_description', 'team_thumnail', 'team_name', 'team_work', 'team_video_link'
];

}
