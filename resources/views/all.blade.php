@include('layout.header')
<section class="bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/allCover.png') }}')">
    <div class="mx-auto max-w-7xl px-6 py-16 sm:py-24 md:py-32">
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-medium text-white">{{ __('posts.all_title') }}</h1>
    </div>
</section>
<section class="mx-auto max-w-7xl px-6 py-16 sm:py-24 md:py-32">

    <div class="mb-16 md:mb-24">
         <p class="flex items-center justify-start gap-2 text-sm text-custom-orange"><img src="{{ asset('images/lineOrange.png') }}" class="w-4 h-px shrink-0" alt="">{{ __('posts.eyebrow') }}</p>
        <h2 class="text-2xl sm:text-3xl font-medium mb-8">{{ __('posts.news_title') }}</h2>

        @if ($latestNews->isEmpty())
            <p class="text-lg text-gray-600 mb-8">{{ __('posts.no_news') }}</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mb-8">
                @foreach ($latestNews as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        @endif

        <a href="{{ route('news.index') }}" class="flex items-center gap-1 text-sm font-semibold text-custom-orange">{{ __('posts.view_all_news') }}<span>&rarr;</span></a>
    </div>

    <div>
         <p class="flex items-center justify-start gap-2 text-sm text-custom-orange"><img src="{{ asset('images/lineOrange.png') }}" class="w-4 h-px shrink-0" alt="">{{ __('posts.eyebrow') }}</p>
        <h2 class="text-2xl sm:text-3xl font-medium mb-8">{{ __('posts.events_title') }}</h2>

        @if ($latestEvents->isEmpty())
            <p class="text-lg text-gray-600 mb-8">{{ __('posts.no_events') }}</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mb-8">
                @foreach ($latestEvents as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        @endif

        <a href="{{ route('events.index') }}" class="flex items-center gap-1 text-sm font-semibold text-custom-orange">{{ __('posts.view_all_events') }}<span>&rarr;</span></a>
    </div>
</section>
@include('layout.footer')
