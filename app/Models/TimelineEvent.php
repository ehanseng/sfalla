<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimelineEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'category_id',
        'cover_image_url',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
