@extends('layouts.app')

@section('title', __('login.title'))

@section('description', __('login.description'))

@section('robots', 'noindex,follow')

@section('content')

    @include('partials.nav')

    <div class="flex min-h-0">
        <div class="relative hidden lg:flex flex-1 flex-col items-start justify-between p-16">
            <img
                src="{{ asset('images/login.avif') }}"
                alt="{{ __('login.image-alt') }}"
                class="absolute inset-0 w-full h-full object-cover"
                fetchpriority="high"
            >
            <div class="absolute inset-0 bg-[rgba(17,17,17,0.35)]"></div>

            {{-- Badge atelier --}}
            <div class="relative flex items-center gap-2 z-10">
                <x-icons.angle />
                <span class="font-semibold text-white text-[12px] uppercase tracking-wider">
                    {{ __('login.baseline') }}
                </span>
            </div>

            {{-- Texte du bas --}}
            <div class="relative z-10 flex flex-col gap-4 w-full">
                <h2 class="font-bold text-white text-[32px] leading-[1.2]">
                    {{ __('login.freeze') }}.
                </h2>

                <p class="text-[#e5e7eb] text-[15px] leading-[1.5] max-w-sm">
                    {{ __('login.freeze-text') }}.
                </p>

                <div class="flex gap-6 pt-4">
                    <div class="flex flex-col gap-1">
                        <span class="font-bold text-white text-[16px]">{{ __('login.temperature') }}</span>
                        <span class="text-[#9ca3af] text-[12px]">{{ __('login.temperature-text') }}</span>
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="font-bold text-white text-[16px]">{{ __('login.altitude') }}</span>
                        <span class="text-[#9ca3af] text-[12px]">{{ __('login.altitude-text') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Colonne de droite (formulaire) --}}
        <div class="half-page-content flex flex-1 flex-col items-center justify-between bg-white p-6">
                <div class="w-full lg:max-w-sm flex flex-col gap-8">
                {{-- En-tête du formulaire --}}
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-2">
                        <x-icons.angle color="bg-ef-red" />
                        <span class="font-semibold text-ef-red text-[11px] uppercase tracking-wider">
                            {{ __('login.collector_space') }}
                        </span>
                    </div>

                    <h1 class="font-extrabold text-[#111] text-[32px]">
                        {{ __('login.login') }}
                    </h1>

                    <p class="text-[#6b6b6b] text-[14px] leading-[1.4]">
                        {{ __('login.login-text') }}
                    </p>
                </div>

                {{-- Formulaire --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="flex flex-col gap-2 mb-4">
                        <label for="email" class="font-semibold text-[#111] text-[13px]">
                            {{ __('login.email') }}
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            autocomplete="email"
                            value="{{ old('email') }}"
                            placeholder="{{ __('login.email-text') }}"
                            class="w-full rounded-[2px] border px-4 py-3 text-[14px] text-[#111] placeholder:text-[#9ca3af] outline-none transition-colors
                                {{ $errors->has('email')
                                    ? 'border-[#e8aeb8] bg-[#fdf5f6] focus:border-ef-red'
                                    : 'border-[#e5e7eb] bg-white focus:border-[#111]' }}"
                        />

                        @error('email')
                            <span class="text-ef-red text-[11px] mb-4 -mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Mot de passe --}}
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <label for="password" class="font-semibold text-[#111] text-[13px]">
                                {{ __('login.password') }}
                            </label>

                            <a href="{{ route('password.request') }}" class="ef-link-red-light">
                                {{ __('login.password-lost') }}
                            </a>
                        </div>

                        <div class="relative">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                autocomplete="current-password"
                                placeholder="{{ __('login.password-text') }}"
                                class="w-full rounded-[2px] border px-4 py-3 pr-12 text-[14px] text-[#111] placeholder:text-[#9ca3af] outline-none transition-colors
                                    {{ $errors->has('password')
                                        ? 'border-[#e8aeb8] bg-[#fdf5f6] focus:border-ef-red'
                                        : 'border-[#e5e7eb] bg-white focus:border-[#111]' }}"
                            />

                            <button
                                type="button"
                                id="toggle-password"
                                class="cursor-pointer absolute right-4 top-1/2 -translate-y-1/2 text-[#6b6b6b]"
                                aria-label="{{ __('login.show-password') }}"
                            >
                                <x-icons.eye id="icon-eye" class="block" />
                                <x-icons.eye-slash id="icon-eye-slash" class="hidden" />
                            </button>
                        </div>

                        @error('password')
                            <span class="text-ef-red text-[11px] mb-4 -mt-2">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="ef-button-red mt-5 mb-2"
                        aria-label="{{ __('login.login') }}"
                    >
                        {{ __('login.login') }}
                    </button>

                    <p class="text-center text-[#6b6b6b] text-[14px]">
                        {{ __('login.new-collector') }}

                        <a href="{{ route('register') }}" class="ef-link-black-strong mt-2">
                            {{ __('login.create-account') }}
                        </a>
                    </p>
                </form>

                <div class="flex flex-col items-center gap-3 border-t border-[#e5e7eb] pt-6 md:flex-row md:justify-between md:gap-0">
                    <p class="text-ef-text-grey text-[13px]">
                        {{ __('login.issue') }}
                    </p>

                    <a href="{{ route('contact') }}" class="ef-link-black-light">
                        <x-icons.envelop />
                        {{ __('login.contact-me') }}
                    </a>
                </div>

                <div class="flex items-center gap-2 mt-8">
                    <x-icons.secure />
                    <span class="text-ef-text-grey text-[11px] uppercase tracking-wider">
                        {{ __('login.secure') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            window.loginTranslations = {{ Js::from([
                'show_password' => __('login.show-password'),
                'hide_password' => __('login.hide-password'),
            ]) }};
        </script>
        @vite('resources/js/pages/login.js')
    @endpush

@endsection
