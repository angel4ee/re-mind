<?php

namespace App\Models;

use App\Enums\PostType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasTranslations;

    protected $table = 'posts';

    protected $guarded = [];

    public array $translatable = ['title', 'slug', 'excerpt', 'category', 'body'];

    protected function casts(): array
    {
        return [
            'type' => PostType::class,
            'published_at' => 'datetime',
        ];
    }

    public function images(): HasMany
    {
        return $this->hasMany(PostImage::class)->orderBy('sort');
    }

    protected static function booted(): void
    {
        static::saving(function (Post $post) {
            if (! $post->isDirty('body')) {
                return;
            }

            foreach ($post->getTranslations('body') as $locale => $html) {
                $post->setTranslation('body', $locale, clean($html));
            }
        });
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function scopeOfType(Builder $query, PostType $type): Builder
    {
        return $query->where('type', $type);
    }

    /**
     * Only posts that actually have a title and slug for the given locale
     * (defaults to the current app locale). Posts missing a translation
     * for a locale simply don't appear on that locale's site — they are
     * not machine-translated or shown with English fallback text, since
     * the route model binding below is locale-strict and would 404 on
     * the resulting link otherwise.
     */
    public function scopeTranslatedIn(Builder $query, ?string $locale = null): Builder
    {
        $locale ??= app()->getLocale();

        return $query->whereNotNull('title->'.$locale)->whereNotNull('slug->'.$locale);
    }

    public function resolveRouteBinding($value, $field = null): ?self
    {
        return $this->where('slug->'.app()->getLocale(), $value)->firstOrFail();
    }

    public function getRouteKey(): string
    {
        return $this->getTranslation('slug', app()->getLocale());
    }
}
