@props(['post'])

@php
    $isEvent = $post->type === \App\Enums\PostType::Event;
    $showRoute = $isEvent ? route('events.show', $post) : route('news.show', $post);
@endphp

<a href="{{ $showRoute }}" class="group block overflow-hidden rounded-lg border border-gray-100 bg-white shadow-sm transition hover:shadow-md">
    <div class="relative aspect-16/10 w-full overflow-hidden bg-custom-gray-light">
        <span
            class="absolute left-4 top-4 z-10 inline-block rounded px-2 py-1 text-xs font-semibold uppercase tracking-wide {{ $isEvent ? 'bg-custom-purple text-white' : 'bg-custom-orange text-black' }}"
        >
            {{ $post->type->getLabel() }}
        </span>
        @if($post->cover_image)
            <img src="{{ asset('storage/'.$post->cover_image) }}" alt="{{ $post->title }}" loading="lazy" class="h-full w-full object-cover transition duration-200 group-hover:scale-105">
        @endif
    </div>
    <div class="p-5">
        @if($post->published_at || $post->category)
            <p class="flex items-center gap-2 text-xs text-custom-purple">
                @if($post->published_at)
                    <span>{{ $post->published_at->translatedFormat('j F Y') }}</span>
                @endif
                @if($post->published_at && $post->category)
                    <span>|</span>
                @endif
                @if($post->category)
                    <span>{{ $post->category }}</span>
                @endif
            </p>
        @endif
        <h3 class="mt-2 text-lg font-medium text-gray-900 group-hover:text-custom-orange">{{ $post->title }}</h3>
        @if($post->excerpt)
            <p class="mt-2 text-sm text-gray-600 line-clamp-3">{{ $post->excerpt }}</p>
        @endif
        <div class="mt-4 border-t border-gray-100 pt-4">
            <p class="flex items-center gap-1 text-sm font-semibold text-custom-orange">
                {{ __('posts.read_more') }}<span>&rarr;</span>
            </p>
        </div>
    </div>
</a>
