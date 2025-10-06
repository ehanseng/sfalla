<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Post extends Model implements Sitemapable
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'cover_image_url',
        'category_id',
        'status',
        'meta_title',
        'meta_description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function toSitemapTag(): Url | string | array
    {
        return route('van-life.show', $this);
    }
}
