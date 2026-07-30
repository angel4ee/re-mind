@include('layout.header')
<section class="mx-auto max-w-3xl px-6 py-16 sm:py-24 md:py-32">
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-medium mb-3">{{ __('privacy.title') }}</h1>
    <p class="text-sm text-custom-gray mb-10">{{ __('privacy.last_updated') }}</p>
    <p class="mb-12">{{ __('privacy.intro') }}</p>

    <div class="space-y-10">
        @foreach (['data_we_collect', 'purpose', 'legal_basis', 'retention', 'controller', 'your_rights', 'security', 'changes'] as $key)
            <div>
                <h2 class="text-xl sm:text-2xl font-medium mb-3">{{ __('privacy.sections.'.$key.'.title') }}</h2>
                @foreach (__('privacy.sections.'.$key.'.blocks') as $block)
                    @if (is_array($block))
                        <ul class="list-disc pl-6 space-y-1 mb-4">
                            @foreach ($block as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mb-4">{{ $block }}</p>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
</section>
@include('layout.footer')
