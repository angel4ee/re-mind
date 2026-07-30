<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\News;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_news_and_event_are_scoped_to_their_type(): void
    {
        $news = News::create(['title' => 'News item', 'slug' => 'news-item', 'body' => 'Body']);
        $event = Event::create(['title' => 'Event item', 'slug' => 'event-item', 'body' => 'Body']);

        $this->assertCount(1, News::all());
        $this->assertCount(1, Event::all());
        $this->assertCount(2, Post::all());
        $this->assertTrue(News::first()->is($news));
        $this->assertTrue(Event::first()->is($event));
    }

    public function test_title_is_translatable(): void
    {
        $post = News::create(['title' => 'English title', 'slug' => 'slug', 'body' => 'Body']);
        $post->setTranslation('title', 'mk', 'Наслов');
        $post->save();

        $this->assertSame('English title', $post->fresh()->getTranslation('title', 'en'));
        $this->assertSame('Наслов', $post->fresh()->getTranslation('title', 'mk'));
    }

    public function test_published_scope_excludes_drafts_and_future_posts(): void
    {
        News::create(['title' => 'Draft', 'slug' => 'draft', 'body' => 'Body', 'published_at' => null]);
        News::create(['title' => 'Future', 'slug' => 'future', 'body' => 'Body', 'published_at' => now()->addDay()]);
        $published = News::create(['title' => 'Live', 'slug' => 'live', 'body' => 'Body', 'published_at' => now()->subDay()]);

        $result = Post::published()->get();

        $this->assertCount(1, $result);
        $this->assertTrue($result->first()->is($published));
    }

    public function test_resolve_route_binding_matches_slug_for_active_locale(): void
    {
        $post = News::create(['title' => 'Title', 'slug' => 'english-slug', 'body' => 'Body']);
        $post->setTranslation('slug', 'mk', 'makedonski-slag');
        $post->save();

        app()->setLocale('mk');

        $resolved = (new Post)->resolveRouteBinding('makedonski-slag');

        $this->assertTrue($resolved->is($post));
    }
}
