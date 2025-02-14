<?php

namespace App\Models;

use Spatie\Image\Enums\Fit;
use EloquentFilter\Filterable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable  implements HasMedia
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory, Filterable, InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'password',
        'type'
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
