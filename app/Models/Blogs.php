<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blogs extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'banner_image',
        'banner_title',
        'section1_subtitle',
        'section1_title',
        'section1_description',
        'title',
        'description',
        'card_thumbnail',
        'type',
        'pdf_file',
        'video_source',
        'video_file',
        'video_url',
        'video_thumbnail',
        'thumbnail',
        'published_date',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'published_date' => 'date',
        'is_active' => 'boolean',
    ];

    // ==================== RELATIONSHIPS ====================

    /**
     * Gallery images for this blog
     */
    public function images()
    {
        // Explicitly specify the foreign key to avoid pluralization issues
        return $this->hasMany(BlogsImages::class, 'blog_id')->orderBy('sort_order');
    }

    // ==================== SCOPES ====================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('published_date', 'desc');
    }

    // ==================== ACCESSORS (URL Helpers) ====================

    public function getBannerImageUrlAttribute()
    {
        return $this->banner_image ? asset('storage/' . $this->banner_image) : asset('images/default-banner.jpg');
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->card_thumbnail) {
            return asset('storage/' . $this->card_thumbnail);
        }
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        return asset('images/blog-placeholder-' . $this->type . '.jpg');
    }

    public function getPdfUrlAttribute()
    {
        return $this->pdf_file ? asset('storage/' . $this->pdf_file) : null;
    }

    public function getVideoThumbnailUrlAttribute()
    {
        if ($this->video_thumbnail) {
            return asset('storage/' . $this->video_thumbnail);
        }
        return $this->thumbnail_url;
    }

    // ==================== VIDEO EMBED LOGIC ====================

    public function getEmbedUrlAttribute()
    {
        if ($this->type !== 'video' || $this->video_source !== 'link' || !$this->video_url) {
            return null;
        }

        // YouTube
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/v\/)([a-zA-Z0-9_-]{11})/', $this->video_url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1] . '?rel=0';
        }

        // Vimeo
        if (preg_match('/vimeo\.com\/(\d+)/', $this->video_url, $matches)) {
            return 'https://player.vimeo.com/video/' . $matches[1];
        }

        return $this->video_url;
    }

    // ==================== TYPE HELPERS ====================

    public function getTypeLabelAttribute()
    {
        return match($this->type) {
            'pdf' => 'PDF',
            'video' => 'Video',
            'image' => 'Image',
            default => 'File',
        };
    }

    public function getTypeBadgeColorAttribute()
    {
        return match($this->type) {
            'pdf' => '#1a3a5c',
            'video' => '#e74c3c',
            'image' => '#27ae60',
            default => '#666',
        };
    }

    // ==================== CLEANUP ====================

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($blog) {
            $files = [
                $blog->banner_image,
                $blog->card_thumbnail,
                $blog->thumbnail,
                $blog->pdf_file,
                $blog->video_file,
                $blog->video_thumbnail,
            ];

            foreach ($files as $file) {
                if ($file) {
                    Storage::disk('public')->delete($file);
                }
            }

            foreach ($blog->images as $image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }
        });
    }
}