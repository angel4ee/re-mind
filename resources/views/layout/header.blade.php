<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&family=Literata:ital,opsz,wght@0,7..72,200..900;1,7..72,200..900&family=Oswald:wght@200..700&family=Roboto:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-gray-900 antialiased">
    <header class="border-b border-gray-200">
        <nav class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-6 py-4 min-[851px]:grid min-[851px]:grid-cols-[1fr_auto_1fr]">
            <a href="{{ route('home') }}" class="min-[851px]:justify-self-start">
                <img src="{{ asset('images/Primary Logo_Black Typography_SVG.svg') }}" alt="{{ config('app.name', 'REMIND') }}" class="h-10 w-auto">
            </a>

            <ul class="hidden items-center gap-6 text-center font-sans text-[18px] font-normal min-[851px]:flex min-[851px]:justify-self-center">
                <li><a href="{{ route('home') }}" class="font-normal hover:text-gray-600 {{ request()->routeIs('home') ? 'text-custom-orange' : '' }}">{{ __('nav.home') }}</a></li>
                <li class="relative" data-dropdown>
                    <button type="button" class="flex items-center gap-1.5 rounded-md px-2 py-1.5 font-normal transition-colors hover:text-gray-600 data-open:text-gray-900 {{ request()->routeIs('consortium.*', 'objectives', 'results') ? 'text-custom-orange' : '' }}" data-dropdown-trigger aria-haspopup="true" aria-expanded="false">
                        {{ __('nav.project') }}
                        <svg class="h-3 w-3 text-gray-400 transition-transform duration-150 data-open:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-dropdown-chevron>
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul class="invisible absolute left-0 top-full z-10 mt-2 min-w-40 -translate-y-1 scale-95 rounded-xl border border-gray-100 bg-white p-1.5 opacity-0 shadow-lg shadow-gray-200/50 ring-1 ring-black/5 transition duration-150 ease-out data-open:visible data-open:translate-y-0 data-open:scale-100 data-open:opacity-100" data-dropdown-menu>
                        <li><a href="{{ route('consortium.index') }}" class="block rounded-lg px-3 py-2 font-normal {{ request()->routeIs('consortium.*') ? 'text-custom-orange' : 'text-gray-700' }} transition-colors hover:bg-gray-50 hover:text-gray-900">{{ __('nav.consortium') }}</a></li>
                        <li><a href="{{ route('objectives') }}" class="block rounded-lg px-3 py-2 font-normal {{ request()->routeIs('objectives') ? 'text-custom-orange' : 'text-gray-700' }} transition-colors hover:bg-gray-50 hover:text-gray-900">{{ __('nav.objectives') }}</a></li>
                        <li><a href="{{ route('results') }}" class="block rounded-lg px-3 py-2 font-normal {{ request()->routeIs('results') ? 'text-custom-orange' : 'text-gray-700' }} transition-colors hover:bg-gray-50 hover:text-gray-900">{{ __('nav.results') }}</a></li>
                    </ul>
                </li>
                <li class="relative" data-dropdown data-dropdown-hover>
                    <a href="{{ route('all') }}" class="flex items-center gap-1.5 rounded-md px-2 py-1.5 font-normal transition-colors hover:text-gray-600 data-open:text-gray-900 {{ request()->routeIs('news.*', 'events.*', 'all') ? 'text-custom-orange' : '' }}" data-dropdown-trigger aria-haspopup="true" aria-expanded="false">
                        {{ __('nav.news_events') }}
                        <svg class="h-3 w-3 text-gray-400 transition-transform duration-150 data-open:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-dropdown-chevron>
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <ul class="invisible absolute left-0 top-full z-10 mt-2 min-w-40 -translate-y-1 scale-95 rounded-xl border border-gray-100 bg-white p-1.5 opacity-0 shadow-lg shadow-gray-200/50 ring-1 ring-black/5 transition duration-150 ease-out data-open:visible data-open:translate-y-0 data-open:scale-100 data-open:opacity-100" data-dropdown-menu>
                        <li><a href="{{ route('news.index') }}" class="block rounded-lg px-3 py-2 font-normal {{ request()->routeIs('news.*') ? 'text-custom-orange' : 'text-gray-700' }} transition-colors hover:bg-gray-50 hover:text-gray-900">{{ __('nav.news') }}</a></li>
                        <li><a href="{{ route('events.index') }}" class="block rounded-lg px-3 py-2 font-normal {{ request()->routeIs('events.*') ? 'text-custom-orange' : 'text-gray-700' }} transition-colors hover:bg-gray-50 hover:text-gray-900">{{ __('nav.events') }}</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('contact') }}" class="font-normal hover:text-gray-600 {{ request()->routeIs('contact') ? 'text-custom-orange' : '' }}">{{ __('nav.contact') }}</a></li>
            </ul>

            <div class="hidden items-center gap-4 min-[851px]:flex min-[851px]:justify-self-end">
                <div class="flex items-center gap-3">
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="{{ __('nav.facebook') }}" class="opacity-80 transition-opacity hover:opacity-100">
                        <img src="{{ asset('images/IconFB.png') }}" alt="{{ __('nav.facebook') }}" class="h-5 w-5">
                    </a>
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="{{ __('nav.instagram') }}" class="opacity-80 transition-opacity hover:opacity-100">
                        <img src="{{ asset('images/IconIG.png') }}" alt="{{ __('nav.instagram') }}" class="h-5 w-5">
                    </a>
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="{{ __('nav.linkedin') }}" class="opacity-80 transition-opacity hover:opacity-100">
                        <img src="{{ asset('images/IconLN.png') }}" alt="{{ __('nav.linkedin') }}" class="h-5 w-5">
                    </a>
                    <a href="#" target="_blank" rel="noopener noreferrer" aria-label="{{ __('nav.tiktok') }}" class="opacity-80 transition-opacity hover:opacity-100">
                        <img src="{{ asset('images/TikTokIcon.png') }}" alt="{{ __('nav.tiktok') }}" class="h-5 w-5">
                    </a>
                </div>

                <div class="h-6 w-px bg-black"></div>

                <div class="relative" data-dropdown>
                    <button type="button" class="flex items-center gap-1 text-[15px] font-semibold text-gray-900 transition-colors hover:text-gray-600 data-open:text-gray-600" data-dropdown-trigger aria-haspopup="true" aria-expanded="false">
                        {{ strtoupper(app()->getLocale()) }}
                        <svg class="h-3 w-3 text-gray-400 transition-transform duration-150 data-open:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-dropdown-chevron>
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul class="invisible absolute right-0 top-full z-10 mt-2 min-w-32 -translate-y-1 scale-95 rounded-xl border border-gray-100 bg-white p-1.5 opacity-0 shadow-lg shadow-gray-200/50 ring-1 ring-black/5 transition duration-150 ease-out data-open:visible data-open:translate-y-0 data-open:scale-100 data-open:opacity-100" data-dropdown-menu>
                        @foreach (config('app.available_locales') as $localeCode)
                            <li>
                                <a href="{{ \App\Support\Locale::url($localeCode) }}" class="block rounded-lg px-3 py-2 text-left font-normal transition-colors hover:bg-gray-50 hover:text-gray-900 {{ $localeCode === app()->getLocale() ? 'text-custom-orange' : 'text-gray-700' }}">{{ config('locales.'.$localeCode) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <button type="button" class="inline-flex items-center justify-center rounded-md p-2 text-gray-700 hover:bg-gray-50 hover:text-gray-900 min-[851px]:hidden" data-mobile-menu-trigger aria-label="{{ __('nav.toggle_menu') }}" aria-expanded="false" aria-controls="mobile-menu">
                <svg class="h-6 w-6" data-mobile-menu-icon-open viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                </svg>
                <svg class="hidden h-6 w-6" data-mobile-menu-icon-close viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </nav>

        <div id="mobile-menu" class="hidden min-[851px]:hidden" data-mobile-menu>
            <ul class="flex flex-col gap-1 border-t border-gray-100 px-6 py-4 font-sans text-[18px] font-normal">
                <li><a href="{{ route('home') }}" class="block rounded-md px-3 py-2 font-normal hover:bg-gray-50 hover:text-gray-600 {{ request()->routeIs('home') ? 'text-custom-orange' : '' }}">{{ __('nav.home') }}</a></li>
                <li>
                    <details class="group">
                        <summary class="flex cursor-pointer list-none items-center justify-between rounded-md px-3 py-2 font-normal hover:bg-gray-50 hover:text-gray-600 {{ request()->routeIs('consortium.*', 'objectives', 'results') ? 'text-custom-orange' : '' }}">
                            {{ __('nav.project') }}
                            <svg class="h-3 w-3 text-gray-400 transition-transform duration-150 group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </summary>
                        <ul class="ml-3 mt-1 flex flex-col gap-1 border-l border-gray-100 pl-3">
                            <li><a href="{{ route('consortium.index') }}" class="block rounded-md px-3 py-2 font-normal {{ request()->routeIs('consortium.*') ? 'text-custom-orange' : 'text-gray-700' }} hover:bg-gray-50 hover:text-gray-900">{{ __('nav.consortium') }}</a></li>
                            <li><a href="{{ route('objectives') }}" class="block rounded-md px-3 py-2 font-normal {{ request()->routeIs('objectives') ? 'text-custom-orange' : 'text-gray-700' }} hover:bg-gray-50 hover:text-gray-900">{{ __('nav.objectives') }}</a></li>
                            <li><a href="{{ route('results') }}" class="block rounded-md px-3 py-2 font-normal {{ request()->routeIs('results') ? 'text-custom-orange' : 'text-gray-700' }} hover:bg-gray-50 hover:text-gray-900">{{ __('nav.results') }}</a></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details class="group">
                        <summary class="flex cursor-pointer list-none items-center justify-between rounded-md px-3 py-2 font-normal hover:bg-gray-50 hover:text-gray-600 {{ request()->routeIs('news.*', 'events.*', 'all') ? 'text-custom-orange' : '' }}">
                            {{ __('nav.news_events') }}
                            <svg class="h-3 w-3 text-gray-400 transition-transform duration-150 group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </summary>
                        <ul class="ml-3 mt-1 flex flex-col gap-1 border-l border-gray-100 pl-3">
                            <li><a href="{{ route('all') }}" class="block rounded-md px-3 py-2 font-normal {{ request()->routeIs('all') ? 'text-custom-orange' : 'text-gray-700' }} hover:bg-gray-50 hover:text-gray-900">{{ __('nav.all') }}</a></li>
                            <li><a href="{{ route('news.index') }}" class="block rounded-md px-3 py-2 font-normal {{ request()->routeIs('news.*') ? 'text-custom-orange' : 'text-gray-700' }} hover:bg-gray-50 hover:text-gray-900">{{ __('nav.news') }}</a></li>
                            <li><a href="{{ route('events.index') }}" class="block rounded-md px-3 py-2 font-normal {{ request()->routeIs('events.*') ? 'text-custom-orange' : 'text-gray-700' }} hover:bg-gray-50 hover:text-gray-900">{{ __('nav.events') }}</a></li>
                        </ul>
                    </details>
                </li>
                <li><a href="{{ route('contact') }}" class="block rounded-md px-3 py-2 font-normal hover:bg-gray-50 hover:text-gray-600 {{ request()->routeIs('contact') ? 'text-custom-orange' : '' }}">{{ __('nav.contact') }}</a></li>
                <li class="mt-2 border-t border-gray-100 pt-2">
                    <p class="px-3 pb-1 text-sm font-semibold text-gray-400">{{ __('nav.language') }}</p>
                    <ul class="flex flex-col gap-1">
                        @foreach (config('app.available_locales') as $localeCode)
                            <li>
                                <a href="{{ \App\Support\Locale::url($localeCode) }}" class="block rounded-md px-3 py-2 font-normal hover:bg-gray-50 hover:text-gray-900 {{ $localeCode === app()->getLocale() ? 'text-custom-orange' : 'text-gray-700' }}">{{ config('locales.'.$localeCode) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </header>
    <main class="">
