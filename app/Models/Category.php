<?php

namespace App\Models;

use Spatie\Image\Enums\Fit;
use EloquentFilter\Filterable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, Filterable, HasTranslations, InteractsWithMedia;

    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'discount_id',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
