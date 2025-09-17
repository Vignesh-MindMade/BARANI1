<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutCompany extends Model
{
    use HasFactory;

    protected $table ="company_about";

    protected $fillable = ['years_working_experience', 'content', 'textile_industry','textile_industry_image','food_processing_industry','food_processing_industry_image','oem_processing_industry','oem_processing_industry_image'];

}
