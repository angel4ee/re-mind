@include('layout.header')
<section class="bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/contactCover.png') }}')">
    <div class="mx-auto flex max-w-7xl px-6 py-16 sm:py-24 md:py-32 lg:py-40">
        <div class="max-w-2xl space-y-6 text-white">
            <p class="flex items-center justify-start gap-2 text-sm text-custom-orange"><img src="{{ asset('images/lineOrange.png') }}" class="w-4 h-px shrink-0" alt="">{{ __('contact.hero_eyebrow') }}</p>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-medium text-white">{{ __('contact.hero_title') }}</h1>
        
        </div>
    </div>
</section>

<section>
    <div class="mx-auto max-w-7xl px-6 py-16 md:py-24">
        <div class="grid grid-cols-1 gap-16 lg:grid-cols-2 lg:gap-24">
            <form class="space-y-6">
                <div>
                    <label for="name" class="mb-2 block text-sm font-bold text-gray-900">{{ __('contact.form_name_label') }} <span class="text-red-500">*</span></label>
                    <input id="name" type="text" name="name" required class="w-full border-2 border-black border-solid px-4 sm:px-6 lg:px-10 py-3 mr-3 sm:mr-5">
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-bold text-gray-900">{{ __('contact.form_email_label') }} <span class="text-red-500">*</span></label>
                    <input id="email" type="email" name="email" required class="w-full border-2 border-black border-solid px-4 sm:px-6 lg:px-10 py-3 mr-3 sm:mr-5">
                </div>

                <div>
                    <label for="message" class="mb-2 block text-sm font-bold text-gray-900">{{ __('contact.form_message_label') }}</label>
                    <textarea id="message" name="message" rows="6" class="w-full border-2 border-black border-solid px-4 sm:px-6 lg:px-10 py-3 mr-3 sm:mr-5"></textarea>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-bold text-gray-900">{{ __('contact.form_agreement_label') }} <span class="text-red-500">*</span></label>
                    <div class="flex items-start gap-2">
                        <input id="agreement" type="checkbox" name="agreement" required class="mt-1 h-4 w-4  border-black">
                        <label for="agreement" class="text-sm text-black font-black">{!! __('contact.form_agreement_text', ['link' => '<a href="'.route('privacy').'" class="underline hover:text-gray-900">'.__('nav.privacy_policy').'</a>']) !!}</label>
                    </div>
                </div>

                <button type="submit" class="fshrink-0 bg-custom-orange text-black rounded-none px-4 sm:px-5 py-3 flex items-center justify-center gap-2 text-sm sm:text-base whitespace-nowrap">{{ __('contact.submit_button') }}<span>&rarr;</span></button>
            </form>

            <div>
                <h1 class="text-3xl sm:text-4xl font-medium mt-6 mb-6 min-[950px]:mt-10 min-[950px]:mb-10">{{ __('contact.subtitle') }}</h1>
                <p class="mb-6 min-[950px]:mb-10">{{ __('contact.paragraph') }}</p>
            </div>
        </div>
    </div>
</section>


@include('layout.footer')
