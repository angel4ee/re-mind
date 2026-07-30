@include('layout.header')
<section class="bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/eventCover.png') }}')">
    <div class="mx-auto max-w-7xl px-6 py-16 sm:py-24 md:py-32">
        <p class="flex items-center justify-start gap-2 text-sm text-custom-orange"><img src="{{ asset('images/lineOrange.png') }}" class="w-4 h-px shrink-0" alt="">{{ __('posts.eyebrow') }}</p>
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-medium text-white">{{ __('posts.events_title') }}</h1>
    </div>
</section>
<section class="mx-auto max-w-7xl px-6 py-16 sm:py-24 md:py-32">
    @if ($posts->isEmpty())
        <p class="text-lg text-gray-600">{{ __('posts.no_events') }}</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @foreach ($posts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>
        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    @endif
</section>
@include('layout.footer')
