<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\BlogsImages;

class Blogs extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'type',
        'pdf_file',
        'video_source',
        'video_file',
        'video_url',
        'published_at',
        'status',
        'sort_order'

    ];

    protected $casts = [
        'published_at' => 'datetime',
        'status' => 'boolean',
    ];

    public function images():HasMany
    {
        return $this->hasMany(BlogsImages::class, 'blog_id');
    }

    public function isPdf(): bool
{
    return $this->type === 'pdf';
}

public function isVideo(): bool
{
    return $this->type === 'video';
}

public function isGallery(): bool
{
    return $this->type === 'gallery';
}
}
