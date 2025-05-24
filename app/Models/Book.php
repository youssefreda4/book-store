<?php

namespace App\Models;

use App\Traits\FullTextSearch;
use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Book extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use Filterable, FullTextSearch, HasFactory, HasSlug, HasTranslations, InteractsWithMedia;

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
        'discountable_type',
        'discountable_id',
    ];

    public function getSearchable()
    {
        $locale = session()->get('locale', 'en');

        if ($locale === 'ar') {
            return ['name_ar', 'description_ar'];
        }

        return ['name_en', 'description_en'];
    }

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

    public function discountable()
    {
        return $this->morphTo();
    }

    public function addToCart()
    {
        return $this->hasMany(AddToCart::class);
    }

    public function favorite()
    {
        return $this->hasMany(AddToFavorite::class);
    }

    public function cartForCurrentUser()
    {
        return $this->hasOne(AddToCart::class)->where('user_id', auth('web')->id());
    }

    public function getActiveDiscountValue()
    {
        $discount = $this->getValidDiscount();

        return $discount?->percentage;
    }

    public function getValidDiscount()
    {
        $discount = $this->discountable;
        // apply check if discount is currntly active
        if ($discount && ! $this->isDiscountExpired($discount)) {
            return $discount;
        }

        $category_discount = $this->category->discount ?? null;

        if ($category_discount && ! $this->isDiscountExpired($discount)) {
            return $category_discount;
        }
    }

    public function isDiscountExpired($discount)
    {
        // discount
        if ($discount instanceof Discount) {
            return $discount->quantity <= 0 || $discount->expiry_date->isPast();
        }

        // flashsale
        $expiry_date = Carbon::createFromFormat('Y-m-d H:i:s', "$discount->date $discount->start_time")->addHours($discount->time);

        return ! $discount->is_active || $expiry_date->isPast();
    }

    public function getFlashSaleRemainingTimeFormatted($discount)
    {
        try {
            $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $discount->date . ' ' . $discount->start_time);
            $expiryDateTime = $startDateTime->copy()->addHours($discount->time);
            $now = Carbon::now();

            if (!$discount->is_active) {
                return '00:00:00';
            }

            $remainingSeconds = $now->diffInSeconds($expiryDateTime, false);

            if ($remainingSeconds <= 0) {
                return '00:00:00';
            }

            $h = floor($remainingSeconds / 3600);
            $m = floor(($remainingSeconds % 3600) / 60);
            $s = $remainingSeconds % 60;

            return sprintf('%02d:%02d:%02d', $h, $m, $s);
        } catch (\Exception $e) {
            return '00:00:00';
        }
    }

    function getPrice()
    {
        $discount = $this->getValidDiscount();
        $bookPrice = $discount
            ? $this->price - ($this->price * $discount->percentage / 100)
            : $this->price;

        return $bookPrice;
    }
}
