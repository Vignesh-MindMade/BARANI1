<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeProduct extends Model
{
    use HasFactory;


    protected $table ="home_products";
    protected $fillable = [
    'our_description', 'textile_heading', 'textile_description', 'textile_image', 'food_heading', 'food_description', 'food_image',
    'oem_image','oem_description','oem_heading'];

}
