<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCounts extends Model
{
    use HasFactory;

        protected $table ="home_counts";

         protected $fillable = ['product_count', 'client_count', 'Satisfaction_percentage','years_of_experience_count','brand_image_1','brand_image_2','brand_image_3','brand_image_4','brand_image_5','thumbnail','youtube_link'];
}
