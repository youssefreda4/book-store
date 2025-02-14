<?php

namespace App\Models;

use Spatie\Image\Enums\Fit;
use Spatie\Sluggable\HasSlug;
use EloquentFilter\Filterable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Book extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory, Filterable, HasTranslations, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'quantity',
        'rate',
        'publish_year',
        'price',
        'is_available',
        'discountable',
        'category_id',
        'publisher_id',
        'author_id',
    ];

    public $translatable = ['name', 'description'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function isAvailable()
    {
        if ($this->is_available) {
            return '<span class="badge bg-success rounded">' . __('book.available') . '</span>';
        }
        return '<span class="badge bg-danger rounded">' . __('book.not_available') . '</span>';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
