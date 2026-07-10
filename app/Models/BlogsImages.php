<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blogs;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogsImages extends Model
{
    use HasFactory;
    protected $table = 'blogs_images';
    protected $fillable = [
        'blog_id',
        'image',
        'caption',
        'sort_order'
    ];

    public function blog():BelongsTo
    {
        return $this->belongsTo(Blogs::class);
    }

    
        public function getImageUrlAttribute(): string
{
    return asset('storage/' . $this->image);
}
}
