<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'product_view_page';
    protected $fillable = [
        'catagory_id',
        'banner',
        'product_title',
        'product_description',
        'product_broucher',
        'product_image',
        'product_video',
         'Section_2_title',
        'industries_used_in_description',
        'Point_1_title',
        'industries_used_in_automotive_points',
        'Point_2_title',
        'industries_used_in_consumer_goods_points',
        'Point_3_title',
        'industries_used_in_industrial_machinery_points',
        'Section_3_title',
        'features_points',
        'Section_4_title',
        'specifications_points',
        'optional_title',
        'attachments_collection',
        'attachment_1_image',
        'attachment_1_catagory_points',
        'attachment_1_title',
        'attachment_1_description',
        'attachment_2_image',
        'attachment_2_catagory_points',
        'attachment_2_title',
        'attachment_2_description',
    ];

    protected $casts = [
        'specifications_points' => 'array',
        'features_points' => 'array',
        'attachments_collection' => 'array',
        'product_image'=> 'array',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCatagory::class, 'catagory_id', 'id');
    }

    protected static function boot()
{
    parent::boot();

    static::creating(function ($product) {
        $product->slug = \Str::slug($product->product_title);
    });

    static::updating(function ($product) {
        $product->slug = \Str::slug($product->product_title);
    });
    
}

public function getFirstImageAttribute()
{
    // If product_image is already null
    if (empty($this->product_image)) {
        return null;
    }

    // If Laravel casts it to array
    if (is_array($this->product_image)) {
        return $this->product_image[0] ?? null;
    }

    // If it’s a JSON string
    $images = json_decode($this->product_image, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($images) && count($images)) {
        return $images[0];
    }

    // Fallback: it could be a plain string
    return $this->product_image;
}


}