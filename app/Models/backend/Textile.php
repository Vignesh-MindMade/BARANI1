<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Textile extends Model
{
    use HasFactory;

    protected $table = "textiles";

    protected $fillable = [
        'product_textile_id',
        'product_thumbnail',
        'product_name',
        'product_description',
        'product_brouchure',
        'images',
        'points', // JSON field
    ];

    protected $casts = [
        'points' => 'array',
        'images' => 'array'
    ];

    public function productTextile()
    {
        return $this->belongsTo(ProductTextile::class, 'product_textile_id');
    }
}
