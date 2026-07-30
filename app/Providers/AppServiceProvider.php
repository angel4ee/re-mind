<?php

namespace App\Providers;

use Illuminate\Foundation\Console\ServeCommand;
use Illuminate\Support\ServiceProvider;
use Spatie\Translatable\Translatable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app(Translatable::class)->fallback(
            fallbackLocale: config('app.fallback_locale'),
            fallbackAny: true,
        );

        // `php artisan serve` strips almost all env vars from the spawned
        // `php -S` process, keeping only an explicit allowlist. TEMP/TMP
        // aren't on it, so on Windows PHP falls back to resolving its temp
        // dir to C:\Windows (not writable by a normal user) — every file
        // upload then fails with "unable to create a temporary file".
        // https://github.com/laravel/framework/blob/master/src/Illuminate/Foundation/Console/ServeCommand.php
        ServeCommand::$passthroughVariables = [
            ...ServeCommand::$passthroughVariables,
            'TEMP',
            'TMP',
        ];
    }
}
