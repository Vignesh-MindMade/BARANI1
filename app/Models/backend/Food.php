<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

        protected $table = "food";

    protected $fillable = [
        'product_food_id',
        'product_thumbnail',
        'product_name',
        'product_description',
        'product_brouchure',
        'images',
        'points', 
    ];

    protected $casts = [
        'points' => 'array',
        'images' => 'array'
    ];

    public function productFood()
    {
        return $this->belongsTo(ProductFood::class, 'product_food_id');
    }
}
