    </main>
    <footer class="bg-black text-white">
        <div class="mx-auto flex max-w-7xl flex-col gap-10 px-6 py-10 md:flex-row md:justify-between">
            <div class="max-w-xl">
                <img src="{{ asset('images/65caff4b335e53e575100f4b432ac70bf1c086b8.png') }}" alt="{{ __('nav.co_funded_by') }}" class="h-10 w-auto">
                <p class="mt-4 text-xs text-gray-300">
                    {{ __('nav.funded_by') }}
                </p>
                <ul class="mt-4 flex flex-wrap gap-x-6 gap-y-2 text-sm">
                    <li><a href="{{ route('privacy') }}" class="text-custom-gray hover:text-gray-300">{{ __('nav.privacy_policy') }}</a></li>
                    <li><a href="{{ route('cookies-policy') }}" class="text-custom-gray hover:text-gray-300">{{ __('nav.cookies_policy') }}</a></li>
                    <li><a href="{{ route('accessibility-statement') }}" class="text-custom-gray hover:text-gray-300">{{ __('nav.accessibility_statement') }}</a></li>
                    <li><a href="https://eacea.ec.europa.eu" target="_blank" rel="noopener" class="text-custom-gray hover:text-gray-300">EACEA</a></li>
                </ul>
            </div>

            <div class="md:text-right">
                <div class="flex flex-col gap-1 md:flex-row md:items-baseline md:justify-end md:gap-3">
                    <img src="{{ asset('images/Primary Logo_White Typography_SVG.svg') }}" alt="{{ config('app.name', 'REMIND') }}" class="h-10 w-auto md:ml-auto">
                </div>
                <p class="mt-4 text-sm text-custom-gray">{{ __('nav.project_number_label') }}<strong class=" text-white"> 101255799</strong></p>
                <p class="text-sm text-custom-gray">{{ __('nav.call_number_label') }} <strong class=" text-white">CREA-CULT-2025-COOP-2</strong></p>
                <p class="text-sm text-custom-gray">{{ __('nav.contact_email_label') }} <strong class=" text-white"><a href="mailto:hello@remind-project.com" class="hover:text-gray-300">hello@remind-project.com</a></strong></p>
            </div>
        </div>
    </footer>
</body>
</html>
