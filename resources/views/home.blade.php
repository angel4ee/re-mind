@include('layout.header')
<section class="bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/homeCover.png') }}')">
    <div class="mx-auto flex max-w-7xl px-6 py-16 sm:py-24 md:py-32 lg:py-40">
        <div class="max-w-2xl space-y-6 text-white">
            <p class="flex items-center justify-start gap-2 text-sm text-custom-orange"><img src="{{ asset('images/lineOrange.png') }}" class="w-4 h-px shrink-0" alt="">{{ __('home.hero_eyebrow') }}</p>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-medium text-white">RE-MIND</h1>
            <p class="italic font-bold text-lg sm:text-xl text-white">{{ __('home.hero_tagline') }}</p>
            <div class="flex flex-wrap gap-4 pt-2">
                <a href="{{ route('objectives') }}" class="bg-custom-orange text-black rounded-none px-5 py-3 flex items-center gap-2 whitespace-nowrap text-sm sm:text-base">{{ __('home.discover_button') }}<span>&rarr;</span></a>
                <a href="{{ route('all') }}" class="bg-transparent text-white rounded-none flex items-center px-5 py-3 gap-2 whitespace-nowrap text-sm sm:text-base">{{ __('home.news_events_button') }}<span>&rarr;</span></a>
            </div>
        </div>
    </div>
</section>



<section class="mx-auto flex flex-col min-[950px]:flex-row max-w-7xl mt-12 mb-20 min-[950px]:mt-20 min-[950px]:mb-40 px-6 gap-10 lg:gap-20">
    <div class="w-full min-[950px]:w-1/2">

    <p class="flex items-center justify-start gap-2 text-sm text-custom-orange"><img src="{{ asset('images/lineOrange.png') }}" class="w-4 h-px shrink-0" alt="">{{ __('home.about_eyebrow') }}</p>
    <h1 class="text-3xl sm:text-4xl font-medium mt-6 mb-6 min-[950px]:mt-10 min-[950px]:mb-10">{{ __('home.about_title') }}</h1>
    <p class="mb-6 min-[950px]:mb-10">{{ __('home.about_paragraph_1') }}</p>
    <p class="mb-10 min-[950px]:mb-20">{{ __('home.about_paragraph_2') }}</p>
    <div>
        <a href="{{ route('objectives') }}" class="bg-custom-orange text-black rounded-none px-5 py-3 flex items-center gap-2 text-sm sm:text-base whitespace-nowrap w-fit">{{ __('home.learn_more_button') }}<span>&rarr;</span></a>
    </div>
</div>
<div class="w-full min-[950px]:w-1/2 mt-10 mb-5 min-[950px]:mb-0 flex min-[950px]:items-center">
<img src="{{ asset('images/homeSideImage.png') }}" alt="RE-MIND" class="w-full h-auto object-cover">
</div>
</section>

<section class="bg-custom-gray-light ">
     <div class="py-16 md:py-24 mx-auto max-w-7xl px-6">
        <div class="space-y-6 flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <p class="flex items-center justify-start gap-2 text-sm text-custom-orange"><img src="{{ asset('images/lineOrange.png') }}" class="w-4 h-px shrink-0" alt="">{{ __('home.touch_eyebrow') }}</p>
                <h1 class="text-3xl sm:text-4xl md:text-6xl md:max-w-md font-medium text-black">{{ __('home.touch_title') }}</h1>
            </div>

            <a href="{{ route('all') }}" class="w-full sm:w-auto md:mr-0 md:ml-auto bg-custom-orange text-black rounded-none px-5 py-3 my-8 md:my-15 flex items-center justify-center md:justify-start gap-2 text-sm sm:text-base whitespace-nowrap">{{ __('home.browse_button') }}<span>&rarr;</span></a>
        </div>

        @if ($latestPost)
            <div class="mt-4 md:mt-8 mb-8 md:mb-0 max-w-sm">
                <x-post-card :post="$latestPost" />
            </div>
        @endif
</div>

</section>
<section class="mx-auto flex flex-col  max-w-7xl mt-12 mb-20 md:mt-20 md:mb-40 px-6">
  <div class="flex flex-wrap justify-center items-start gap-6 md:gap-8">
    @foreach (config('consortium') as $slug => $partner)
        <a href="{{ route('consortium.show', $slug) }}" class="flex flex-col items-center gap-2 w-[calc(50%-0.75rem)] sm:w-[calc(33.3333%-1rem)] md:w-[calc(16.6667%-1.6667rem)]">
            <div class="flex h-24 sm:h-32 w-full items-center justify-center">
                <img src="{{ asset($partner['logo']) }}" alt="{{ __('consortium.partners.'.$slug.'.name') }}" class="max-h-full max-w-full object-contain">
            </div>
            <p class="text-center text-xs text-gray-600">{{ __('consortium.partners.'.$slug.'.name') }}</p>
        </a>
    @endforeach
  </div>
  <a href="{{ route('consortium.index') }}" class="mx-auto bg-custom-orange text-black rounded-none px-5 sm:px-7 py-3 my-8 md:my-15 flex items-center gap-2 text-sm sm:text-base whitespace-nowrap">{{ __('home.partners_button') }}<span>&rarr;</span></a>
</div>
</section>
<section class="bg-custom-gray-light mb-20">
     <div class="py-16 md:py-24 mx-auto flex flex-col lg:flex-row lg:items-center  max-w-7xl px-6">
        <div>
            <p class="flex items-center justify-start gap-2 text-sm text-custom-orange"><img src="{{ asset('images/lineOrange.png') }}" class="w-4 h-px shrink-0" alt="">{{ __('home.newsletter_eyebrow') }}</p>
            <h1 class="text-3xl sm:text-4xl md:text-6xl lg:max-w-xxl font-medium text-black">{{ __('home.newsletter_title') }}</h1>
</div>
<div class="flex flex-col w-full lg:w-auto lg:mr-0 lg:ml-auto">
        <label class="font-bold mb-2">{{ __('home.newsletter_email_label') }}</label>
        <div class="flex w-full lg:w-auto">
            <input class="flex-1 min-w-0 max-w-xs lg:flex-none lg:w-auto border-2 border-black border-solid px-4 sm:px-6 lg:px-10 py-3 mr-3 sm:mr-5" type="email" name="email" >
            <button class="shrink-0 bg-custom-orange text-black rounded-none px-4 sm:px-5 py-3 flex items-center justify-center gap-2 text-sm sm:text-base whitespace-nowrap">{{ __('home.newsletter_subscribe_button') }}<span>&rarr;</span></button>
        </div>
</div>
</div>

</section>
@include('layout.footer')
