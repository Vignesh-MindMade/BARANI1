<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogsImages extends Model
{
    use HasFactory;

    protected $table = 'blogs_images';

    protected $fillable = [
        'blog_id',
        'image_path',
        'caption',
        'sort_order',
    ];

    public function blog()
    {
        return $this->belongsTo(Blogs::class, 'blog_id');
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
}