@extends('layouts.app')

@section('title', __('register.title'))

@section('description', __('register.description'))

@section('robots', 'noindex,follow')

@section('content')

    @include('partials.nav')

    <div class="flex min-h-0">

        {{-- Colonne de gauche : visuel --}}
        <div class="relative hidden lg:flex flex-1 flex-col items-start justify-between p-16">

            <img
                src="{{ asset('images/register.avif') }}"
                alt="{{ __('register.image-alt') }}"
                class="absolute inset-0 w-full h-full object-cover"
            />

            <div class="absolute inset-0 bg-[rgba(17,17,17,0.35)]"></div>

            {{-- Badge atelier --}}
            <div class="relative flex items-center gap-2 z-10">

                <x-icons.angle />

                <span class="font-semibold text-white text-[12px] uppercase tracking-wider">
                    {{ __('register.baseline') }}
                </span>

            </div>

            {{-- Texte du bas --}}
            <div class="relative z-10 flex flex-col gap-4 w-full">

                <h2 class="font-bold text-white text-[32px] leading-[1.2]">
                    {{ __('register.join') }}.
                </h2>

                <p class="text-[#e5e7eb] text-[15px] leading-[1.5] max-w-sm">
                    {{ __('register.join-text') }}.
                </p>

                <div class="flex gap-6 pt-4">

                    <div class="flex flex-col gap-1">
                        <span class="font-bold text-white text-[16px]">
                            {{ __('register.temperature') }}
                        </span>

                        <span class="text-[#9ca3af] text-[12px]">
                            {{ __('register.temperature-text') }}
                        </span>
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="font-bold text-white text-[16px]">
                            {{ __('register.altitude') }}
                        </span>

                        <span class="text-[#9ca3af] text-[12px]">
                            {{ __('register.altitude-text') }}
                        </span>
                    </div>

                </div>

            </div>

        </div>

        {{-- Colonne de droite : formulaire --}}
        <div class="flex flex-1 flex-col items-center justify-between bg-white px-6 pt-8 pb-20 lg:px-12 lg:py-10">

            <div class="w-full lg:max-w-sm flex flex-col gap-8">

                {{-- En-tête du formulaire --}}
                <div class="flex flex-col gap-3">

                    <div class="flex items-center gap-2">

                        <x-icons.angle color="bg-ef-red" />

                        <span class="font-semibold text-ef-red text-[11px] uppercase tracking-wider">
                            {{ __('register.collector_space') }}
                        </span>

                    </div>

                    <h1 class="font-extrabold text-[#111] text-[32px]">
                        {{ __('register.register') }}
                    </h1>

                    <p class="text-[#6b6b6b] text-[14px] leading-[1.4]">
                        {{ __('register.register-text') }}
                    </p>

                </div>

                {{-- Formulaire --}}
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Nom --}}
                    <div class="flex flex-col gap-2 mb-4">

                        <label for="name" class="font-semibold text-[#111] text-[13px]">
                            {{ __('register.name') }}
                        </label>

                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            placeholder="{{ __('register.name-text') }}"
                            required
                            autofocus
                            autocomplete="name"
                            class="w-full rounded-[2px] border px-4 py-3 text-[14px] text-[#111] placeholder:text-[#9ca3af] outline-none transition-colors
                                {{ $errors->has('name')
                                    ? 'border-[#e8aeb8] bg-[#fdf5f6] focus:border-ef-red'
                                    : 'border-[#e5e7eb] bg-white focus:border-[#111]' }}"
                        />

                        @error('name')
                            <span class="text-ef-red text-[11px] mb-4 -mt-2">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    {{-- Email --}}
                    <div class="flex flex-col gap-2 mb-4">

                        <label for="email" class="font-semibold text-[#111] text-[13px]">
                            {{ __('register.email') }}
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="{{ __('register.email-text') }}"
                            required
                            autocomplete="username"
                            class="w-full rounded-[2px] border px-4 py-3 text-[14px] text-[#111] placeholder:text-[#9ca3af] outline-none transition-colors
                                {{ $errors->has('email')
                                    ? 'border-[#e8aeb8] bg-[#fdf5f6] focus:border-ef-red'
                                    : 'border-[#e5e7eb] bg-white focus:border-[#111]' }}"
                        />

                        @error('email')
                            <span class="text-ef-red text-[11px] mb-4 -mt-2">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    {{-- Mot de passe --}}
                    <div class="flex flex-col gap-2 mb-4">

                        <label for="password" class="font-semibold text-[#111] text-[13px]">
                            {{ __('register.password') }}
                        </label>

                        <div class="relative">

                            <input
                                id="password"
                                name="password"
                                type="password"
                                placeholder="{{ __('register.password-text') }}"
                                required
                                autocomplete="new-password"
                                class="w-full rounded-[2px] border px-4 py-3 pr-12 text-[14px] text-[#111] placeholder:text-[#9ca3af] outline-none transition-colors
                                    {{ $errors->has('password')
                                        ? 'border-[#e8aeb8] bg-[#fdf5f6] focus:border-ef-red'
                                        : 'border-[#e5e7eb] bg-white focus:border-[#111]' }}"
                            />

                            <button
                                type="button"
                                id="toggle-password"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-[#6b6b6b]"
                                aria-label="{{ __('register.show_password') }}"
                            >
                                <x-icons.eye />
                            </button>

                        </div>

                        @error('password')
                            <span class="text-ef-red text-[11px] mb-4 -mt-2">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    {{-- Confirmation du mot de passe --}}
                    <div class="flex flex-col gap-2">

                        <label for="password_confirmation" class="font-semibold text-[#111] text-[13px]">
                            {{ __('register.password-confirmation') }}
                        </label>

                        <div class="relative">

                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                placeholder="{{ __('register.password-confirmation-text') }}"
                                required
                                autocomplete="new-password"
                                class="w-full rounded-[2px] border px-4 py-3 pr-12 text-[14px] text-[#111] placeholder:text-[#9ca3af] outline-none transition-colors
                                    {{ $errors->has('password_confirmation')
                                        ? 'border-[#e8aeb8] bg-[#fdf5f6] focus:border-ef-red'
                                        : 'border-[#e5e7eb] bg-white focus:border-[#111]' }}"
                            />

                            <button
                                type="button"
                                id="toggle-password-confirmation"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-[#6b6b6b]"
                                aria-label="{{ __('register.show_password') }}"
                            >
                                <x-icons.eye />
                            </button>

                        </div>

                        @error('password_confirmation')
                            <span class="text-ef-red text-[11px] mb-4 -mt-2">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="ef-button-red mt-5 mb-2"
                    >
                        {{ __('register.register') }}
                    </button>

                    <p class="text-center text-[#6b6b6b] text-[14px]">

                        {{ __('register.already-registered') }}

                        <a
                            href="{{ route('login') }}"
                            class="ef-link-black-strong mt-2"
                        >
                            {{ __('register.login') }}
                        </a>

                    </p>

                </form>

                {{-- Contact --}}
                <div class="flex flex-col items-center gap-3 border-t border-[#e5e7eb] pt-6 md:flex-row md:justify-between md:gap-0">

                    <p class="text-[#9ca3af] text-[13px]">
                        {{ __('register.issue') }}
                    </p>

                    <a
                        href="{{ route('contact') }}"
                        class="ef-link-black-light"
                    >
                        <x-icons.envelop />

                        {{ __('register.contact-me') }}
                    </a>

                </div>

                {{-- Sécurité --}}
                <div class="flex items-center gap-2 mt-8">

                    <x-icons.secure />

                    <span class="text-[#9ca3af] text-[11px] uppercase tracking-wider">
                        {{ __('register.secure') }}
                    </span>

                </div>

            </div>

        </div>

    </div>

    @push('scripts')

        <script>
            window.registerTranslations = {{ Js::from([
                'show_password' => __('register.show-password'),
                'hide_password' => __('register.hide-password'),
            ]) }};
        </script>

        @vite('resources/js/pages/register.js')

    @endpush

@endsection