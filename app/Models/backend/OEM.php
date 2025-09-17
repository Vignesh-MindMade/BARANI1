<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OEM extends Model
{
    use HasFactory;

            protected $table = "oem";

    protected $fillable = [
        'product_oem_id',
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

    public function productOEM()
    {
        return $this->belongsTo(productOEM::class, 'product_oem_id');
    }
}
