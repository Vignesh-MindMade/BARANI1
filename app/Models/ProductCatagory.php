<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCatagory extends Model
{
    use HasFactory;

    protected $table = 'product_catagory';
    protected $fillable = [
        'catagory',
        'sort_id'
    ];
    public function products()
    {
        return $this->hasMany(Products::class, 'catagory_id', 'id');
    }

    protected static function boot()
{
    parent::boot();

    static::saving(function ($category) {
        if (empty($category->slug)) {
            $category->slug = \Str::slug($category->catagory);
        }
    });
}
}
