<?php

use App\Models\Event;
use App\Models\News;
use App\Models\Post;
use App\Support\Consortium;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/'.config('app.locale'));

Route::prefix('{locale}')
    ->whereIn('locale', config('app.available_locales'))
    ->middleware('setlocale')
    ->group(function () {
        Route::get('/', function () {
            return view('home', [
                'latestPost' => Post::published()->translatedIn()->orderByDesc('published_at')->first(),
            ]);
        })->name('home');

        Route::get('/news', function () {
            return view('news', [
                'posts' => News::published()->translatedIn()->orderByDesc('published_at')->paginate(9),
            ]);
        })->name('news.index');

        Route::get('/news/{news}', function ($locale, string $news) {
            $news = News::where('slug->'.app()->getLocale(), $news)->firstOrFail();

            abort_if(is_null($news->published_at) || $news->published_at->isFuture(), 404);

            return view('news-show', ['post' => $news]);
        })->name('news.show');

        Route::get('/events', function () {
            return view('events', [
                'posts' => Event::published()->translatedIn()->orderByDesc('published_at')->paginate(9),
            ]);
        })->name('events.index');

        Route::get('/events/{event}', function ($locale, string $event) {
            $event = Event::where('slug->'.app()->getLocale(), $event)->firstOrFail();

            abort_if(is_null($event->published_at) || $event->published_at->isFuture(), 404);

            return view('events-show', ['post' => $event]);
        })->name('events.show');

        Route::get('/contact', function () {
            return view('contact');
        })->name('contact');

        Route::get('/results', function () {
            return view('results');
        })->name('results');

        Route::get('/all', function () {
            return view('all', [
                'latestNews' => News::published()->translatedIn()->orderByDesc('published_at')->take(3)->get(),
                'latestEvents' => Event::published()->translatedIn()->orderByDesc('published_at')->take(3)->get(),
            ]);
        })->name('all');

        Route::get('/objectives', function () {
            return view('objectives');
        })->name('objectives');

        Route::get('/consortium', function () {
            return view('consortium');
        })->name('consortium.index');

        Route::get('/consortium/{id}', function ($locale, $id) {
            $partner = config('consortium.'.$id);

            abort_if(is_null($partner), 404);

            return view('consortium-show', [
                'slug' => $id,
                'partner' => $partner,
                'collageImages' => Consortium::collageImages($partner['collage']),
            ]);
        })->name('consortium.show');

        Route::get('/privacy', function () {
            return view('privacy');
        })->name('privacy');

        Route::get('/cookies-policy', function () {
            return view('cookies-policy');
        })->name('cookies-policy');

        Route::get('/accessibility-statement', function () {
            return view('accessibility-statement');
        })->name('accessibility-statement');

        Route::get('/404', function () {
            return view('404');
        })->name('404');
    });
