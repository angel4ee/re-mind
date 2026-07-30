@include('layout.header')
<section class="mx-auto max-w-5xl px-6 py-16 sm:py-24 md:py-32">
    <a href="{{ route('consortium.index') }}" aria-label="{{ __('consortium.back_to_consortium') }}" class="inline-flex items-center gap-2 text-sm text-custom-orange mb-10">&larr;</a>

    <div class="flex h-28 items-center justify-center mb-8">
        <img src="{{ asset($partner['logo']) }}" alt="{{ __('consortium.partners.'.$slug.'.name') }}" class="max-h-full max-w-full object-contain">
    </div>

    @if (! empty($collageImages))
        <div class="flex flex-wrap justify-center gap-4 mb-8">
            @foreach ($collageImages as $image)
                <div class="flex flex-col items-center gap-1 w-27.5">
                    <img src="{{ asset($image['url']) }}" alt="{{ $image['name'] }}" loading="lazy" class="w-27.5 h-auto rounded-lg object-cover">
                    <p class="text-center text-xs text-gray-600">{{ $image['name'] }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <h1 class="text-2xl sm:text-3xl md:text-4xl font-medium mb-8">{{ __('consortium.partners.'.$slug.'.name') }}</h1>

    <div class="space-y-6 max-w-3xl mb-12">
        @foreach (__('consortium.partners.'.$slug.'.bio') as $paragraph)
            <p>{{ $paragraph }}</p>
        @endforeach
    </div>

    @if (! empty($partner['links']))
        <div class="border-t-2 border-black pt-6 max-w-3xl">
            <p class="font-bold mb-3">{{ __('consortium.contact_label') }}</p>
            <ul class="space-y-1">
                @foreach ($partner['links'] as $type => $value)
                    <li>
                        @if ($type === 'email')
                            <a href="mailto:{{ $value }}" class="hover:text-custom-orange">{{ $value }}</a>
                        @elseif ($type === 'phone')
                            <a href="tel:{{ str_replace(' ', '', $value) }}" class="hover:text-custom-orange">{{ $value }}</a>
                        @else
                            <a href="{{ str_starts_with($value, 'http') ? $value : 'https://'.$value }}" target="_blank" rel="noopener noreferrer" class="hover:text-custom-orange">{{ $value }}</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</section>
@include('layout.footer')
