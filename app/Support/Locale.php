<?php

namespace App\Support;

use App\Models\Event;
use App\Models\News;
use Illuminate\Support\Facades\Route;
use Throwable;

class Locale
{
    /**
     * Routes bound to a translatable model's per-locale slug. Swapping the
     * locale segment alone would keep the CURRENT locale's slug value,
     * which the target locale doesn't share — 404. These need the record
     * looked up and re-linked by its slug in the target locale instead.
     */
    protected static array $translatedShowRoutes = [
        'news.show' => ['model' => News::class, 'parameter' => 'news', 'index' => 'news.index'],
        'events.show' => ['model' => Event::class, 'parameter' => 'event', 'index' => 'events.index'],
    ];

    /**
     * Build a URL to the current route in a different locale.
     *
     * Falls back to that locale's home page if the current route can't be
     * regenerated (e.g. a required parameter is missing).
     */
    public static function url(string $targetLocale): string
    {
        $route = Route::current();

        if (! $route || ! $route->getName()) {
            return url('/'.$targetLocale);
        }

        if ($config = static::$translatedShowRoutes[$route->getName()] ?? null) {
            return static::translatedShowUrl($route, $targetLocale, $config);
        }

        try {
            return route($route->getName(), array_merge($route->parameters(), ['locale' => $targetLocale]));
        } catch (Throwable) {
            return route('home', ['locale' => $targetLocale]);
        }
    }

    /**
     * Link to the same record in the target locale, falling back to that
     * locale's listing page if the record has no translation there.
     */
    protected static function translatedShowUrl($route, string $targetLocale, array $config): string
    {
        $post = $config['model']::where('slug->'.app()->getLocale(), $route->parameter($config['parameter']))->first();

        $targetSlug = $post?->getTranslation('slug', $targetLocale, useFallbackLocale: false);

        if (blank($targetSlug)) {
            return route($config['index'], ['locale' => $targetLocale]);
        }

        return route($route->getName(), ['locale' => $targetLocale, $config['parameter'] => $targetSlug]);
    }
}
