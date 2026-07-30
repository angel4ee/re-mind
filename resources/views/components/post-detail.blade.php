@props(['post', 'backRoute', 'backLabel'])

<article class="mx-auto max-w-3xl px-6 py-12 sm:py-16">
    <a
        href="{{ $backRoute }}"
        aria-label="{{ $backLabel }}"
        class="inline-flex h-10 w-10 items-center justify-center rounded-none bg-custom-orange text-xl font-semibold text-black"
    >
        &lsaquo;
    </a>

    <p class="mt-8 flex items-center gap-2 text-sm text-custom-orange">
        <img src="{{ asset('images/lineOrange.png') }}" class="h-px w-4 shrink-0" alt="">
        {{ $post->type->getLabel() }}
        @if($post->published_at)
            &middot; {{ $post->published_at->translatedFormat('j F Y') }}
        @endif
    </p>
    <h1 class="mt-4 text-4xl font-medium text-gray-900 sm:text-5xl md:text-6xl">{{ $post->title }}</h1>

    @if($post->cover_image)
        <img
            src="{{ asset('storage/'.$post->cover_image) }}"
            alt="{{ $post->title }}"
            class="mt-10 w-full rounded-lg object-cover"
        >
    @endif

    <div class="prose mt-10 max-w-none">
        {!! $post->body !!}
    </div>
</article>
