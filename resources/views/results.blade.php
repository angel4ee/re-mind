
@include('layout.header')
<section class="relative bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/resultsCover.png') }}')">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative mx-auto flex max-w-7xl px-6 py-16 sm:py-24 md:py-32 lg:py-40">
        <div class="max-w-2xl space-y-6 text-white">
            <p class="flex items-center justify-start gap-2 text-sm text-custom-orange"><img src="{{ asset('images/lineOrange.png') }}" class="w-4 h-px shrink-0" alt="">{{ __('results.eyebrow') }}</p>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-medium text-white">{{ __('results.title') }}</h1>
        </div>
    </div>
</section>

<section class="mx-auto max-w-7xl px-6 py-16 sm:py-24 md:py-32">
 <div>
    <h2 class="text-xl sm:text-2xl font-semibold uppercase mb-4 max-w-3xl">{{ __('results.intro_title') }}</h2>
    <p class="max-w-3xl text-gray-600 mb-10 md:mb-16">{{ __('results.intro_paragraph') }}</p>
</div>
    @php
        // Icon filenames in public/images/resultsIcon/ are named after the
        // ENGLISH title (e.g. "Mindful Museums Model.png"). Matching on the
        // active locale's (translated) title would break icons on every
        // non-English page, so the lookup always uses the English title —
        // via trans(..., 'en') — while the English item KEYS drive both the
        // display order and which icon each item gets. Items with the same
        // English title share an icon; that's expected, not a bug.
        //
        // One exception: 'capacity_building's English title ("Strengthening
        // the Capacities of Museum Professionals") has no matching file.
        // Confirmed with the client to reuse the same icon as
        // 'policy_recommendations' (title "Capacity Building for Museum
        // Professionals"), which does have a matching file.
        $titleIconOverrides = [
            'Strengthening the Capacities of Museum Professionals' => 'Capacity Building for Museum Professionals.png',
        ];
        $englishItems = trans('results.items', [], 'en');
    @endphp
    <div class="flex flex-wrap justify-center gap-6 md:gap-8">
        @foreach ($englishItems as $key => $englishItem)
            @php
                $item = __('results.items.'.$key);
                $item = is_array($item) ? $item : $englishItem;

                $englishTitle = preg_replace('/\s+/', ' ', trim($englishItem['title']));
                $iconFilename = $titleIconOverrides[$englishTitle] ?? $englishTitle.'.png';
                $iconPath = 'images/resultsIcon/'.$iconFilename;
                $hasIcon = file_exists(public_path($iconPath));
            @endphp
            <div class="shrink-0 grow-0 basis-full border border-black p-6 flex flex-col items-center text-center gap-4 sm:basis-[calc(50%-0.75rem)] lg:basis-[calc(33.333%-1.334rem)]">
                <div class="flex h-24 w-full items-center justify-center">
                    @if ($hasIcon)
                        <img src="{{ asset($iconPath) }}" alt="" loading="lazy" class="max-h-full max-w-full object-contain">
                    @endif
                </div>
                <h2 class="text-xl font-medium">{{ preg_replace('/\s+/', ' ', trim($item['title'])) }}</h2>
                <p class="text-sm text-gray-600">{{ $item['body'] }}</p>
                @if (isset($item['list']))
                    <ul class="list-disc pl-6 space-y-1 text-left text-sm text-gray-600">
                        @foreach ($item['list'] as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>
</section>
@include('layout.footer')
