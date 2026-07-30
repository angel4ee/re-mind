@include('layout.header')
<section class="relative bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/objectivesCover.png') }}')">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative mx-auto flex max-w-7xl px-6 py-16 sm:py-24 md:py-32 lg:py-40">
        <div class="max-w-2xl space-y-6 text-white">
            <p class="flex items-center justify-start gap-2 text-sm text-custom-orange"><img src="{{ asset('images/lineOrange.png') }}" class="w-4 h-px shrink-0" alt="">{{ __('objectives.eyebrow') }}</p>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-medium text-white">{{ __('objectives.title') }}</h1>
        </div>
    </div>
</section>

<section class="mx-auto max-w-7xl px-6 py-16 sm:py-24 md:py-32">
    <div class="flex flex-col gap-16 md:gap-24">
        @foreach (['so1', 'so2', 'so3', 'so4', 'so5', 'so6'] as $index => $key)
            @php $number = $index + 1; $isEven = $index % 2 === 1; @endphp
            <div class="flex flex-col items-start gap-6 md:items-center md:gap-12 {{ $isEven ? 'md:flex-row-reverse' : 'md:flex-row' }}">
                <div class="md:w-1/2">
                    <div class="relative {{ $isEven ? 'pr-16 md:pr-28 md:text-right' : 'pl-16 md:pl-28' }}">
                        <span
                            class="font-heading pointer-events-none absolute -top-6 text-7xl leading-none text-custom-purple select-none md:-top-10 md:text-9xl {{ $isEven ? 'right-0' : 'left-0' }}"
                        >{{ $number }}</span>
                        <h2 class="font-heading text-2xl font-semibold md:text-3xl">{{ 'SO'.$number }}</h2>
                        <p class="mt-4 max-w-md text-gray-600 {{ $isEven ? 'md:ml-auto' : '' }}">{{ __('objectives.items.'.$key) }}</p>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img
                        src="{{ asset('images/objectives/'.$key.'.png') }}"
                        alt=""
                        loading="lazy"
                        class="h-auto w-full object-cover"
                    >
                </div>
            </div>
        @endforeach
    </div>
</section>
@include('layout.footer')
