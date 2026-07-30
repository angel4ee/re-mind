@include('layout.header')
 <section class="relative bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/consortiumCover.jpg') }}')">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative mx-auto flex max-w-7xl px-6 py-16 sm:py-24 md:py-32 lg:py-40">
        <div class="max-w-2xl space-y-6 text-white">
            <p class="flex items-center justify-start gap-2 text-sm text-custom-orange"><img src="{{ asset('images/lineOrange.png') }}" class="w-4 h-px shrink-0" alt="">{{ __('consortium.eyebrow') }}</p>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-medium text-white">{{ __('consortium.title') }}</h1>

        </div>
    </div>
</section>

<section class="mx-auto max-w-7xl px-6 py-16 sm:py-24 md:py-32">
 
    <div>
    <h2 class="text-xl sm:text-2xl font-semibold uppercase mb-4 max-w-3xl">{{ __('consortium.intro_title') }}</h2>
    <p class="max-w-3xl text-gray-600 mb-10 md:mb-16">{{ __('consortium.intro_paragraph') }}</p>
</div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @foreach (config('consortium') as $slug => $partner)
            <a href="{{ route('consortium.show', $slug) }}" class="border border-black p-6 flex flex-col items-center text-center gap-4 hover:bg-custom-gray-light transition-colors">
                <div class="flex h-24 w-full items-center justify-center">
                    <img src="{{ asset($partner['logo']) }}" alt="{{ __('consortium.partners.'.$slug.'.name') }}" class="max-h-full max-w-full object-contain">
                </div>
                <p class="font-medium">{{ __('consortium.partners.'.$slug.'.name') }}</p>
                <p class="text-sm text-gray-600">{{ \Illuminate\Support\Str::limit(__('consortium.partners.'.$slug.'.bio.0'), 110) }}</p>
            </a>
        @endforeach
    </div>
</section>
@include('layout.footer')
