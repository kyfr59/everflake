@extends('layouts.app')

@section('title', __('forgot-password.title'))

@section('description', __('forgot-password.description'))

@section('robots', 'noindex,follow')

@section('content')

    @include('partials.nav')

    <div class="flex min-h-0">
        <div class="relative hidden lg:flex flex-1 flex-col items-start justify-between p-16">
            <img
                src="{{ asset('images/login.avif') }}"
                alt="{{ __('forgot-password.image-alt') }}"
                class="absolute inset-0 w-full h-full object-cover"
                fetchpriority="high"
            >
            <div class="absolute inset-0 bg-[rgba(17,17,17,0.35)]"></div>

            {{-- Badge atelier --}}
            <div class="relative flex items-center gap-2 z-10">
                <x-icons.angle />
                <span class="font-semibold text-white text-[12px] uppercase tracking-wider">
                    {{ __('forgot-password.baseline') }}
                </span>
            </div>

            {{-- Texte du bas --}}
            <div class="relative z-10 flex flex-col gap-4 w-full">
                <h2 class="font-bold text-white text-[32px] leading-[1.2]">
                    {{ __('forgot-password.freeze') }}.
                </h2>

                <p class="text-[#e5e7eb] text-[15px] leading-[1.5] max-w-sm">
                    {{ __('forgot-password.freeze-text') }}.
                </p>

                <div class="flex gap-6 pt-4">
                    <div class="flex flex-col gap-1">
                        <span class="font-bold text-white text-[16px]">{{ __('forgot-password.temperature') }}</span>
                        <span class="text-[#9ca3af] text-[12px]">{{ __('forgot-password.temperature-text') }}</span>
                    </div>

                    <div class="flex flex-col gap-1">
                        <span class="font-bold text-white text-[16px]">{{ __('forgot-password.altitude') }}</span>
                        <span class="text-[#9ca3af] text-[12px]">{{ __('forgot-password.altitude-text') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Colonne de droite (formulaire) --}}
        <div class="half-page-content  flex flex-1 flex-col items-center justify-between bg-white px-6 pt-8 pb-20 lg:px-12 lg:py-10">
            <div class="w-full lg:max-w-sm flex flex-col gap-8">
                {{-- En-tête du formulaire --}}
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-2">
                        <x-icons.angle color="bg-ef-red" />
                        <span class="font-semibold text-ef-red text-[11px] uppercase tracking-wider">
                            {{ __('forgot-password.collector_space') }}
                        </span>
                    </div>

                    <h1 class="font-extrabold text-[#111] text-[32px]">
                        {{ __('forgot-password.forgot-password') }}
                    </h1>

                    <p class="text-[#6b6b6b] text-[14px] leading-[1.4]">
                        {{ __('forgot-password.forgot-password-text') }}
                    </p>
                </div>

                {{-- Statut de session (lien envoyé) --}}
                @if (session('status'))
                    <div class="rounded-[2px] border border-[#bfe3c9] bg-[#f2faf4] px-4 py-3 text-[13px] text-[#1f7a3d]">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Formulaire --}}
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="flex flex-col gap-2 mb-4">
                        <label for="email" class="font-semibold text-[#111] text-[13px]">
                            {{ __('forgot-password.email') }}
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            autofocus
                            autocomplete="email"
                            value="{{ old('email') }}"
                            placeholder="{{ __('forgot-password.email-text') }}"
                            class="w-full rounded-[2px] border px-4 py-3 text-[14px] text-[#111] placeholder:text-[#9ca3af] outline-none transition-colors
                                {{ $errors->has('email')
                                    ? 'border-[#e8aeb8] bg-[#fdf5f6] focus:border-ef-red'
                                    : 'border-[#e5e7eb] bg-white focus:border-[#111]' }}"
                        />

                        @error('email')
                            <span class="text-ef-red text-[11px] mb-4 -mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="ef-button-red mt-5 mb-2"
                        aria-label="{{ __('forgot-password.send-link') }}"
                    >
                        {{ __('forgot-password.send-link') }}
                    </button>

                    <p class="text-center text-[#6b6b6b] text-[14px]">
                        {{ __('forgot-password.remembered') }}

                        <a href="{{ route('login') }}" class="ef-link-black-strong mt-2">
                            {{ __('forgot-password.login-link') }}
                        </a>
                    </p>
                </form>

                <div class="flex flex-col items-center gap-3 border-t border-[#e5e7eb] pt-6 md:flex-row md:justify-between md:gap-0">
                    <p class="text-ef-text-grey text-[13px]">
                        {{ __('forgot-password.issue') }}
                    </p>

                    <a href="{{ route('contact') }}" class="ef-link-black-light">
                        <x-icons.envelop />
                        {{ __('forgot-password.contact-me') }}
                    </a>
                </div>

                <div class="flex items-center gap-2 mt-8">
                    <x-icons.secure />
                    <span class="text-ef-text-grey text-[11px] uppercase tracking-wider">
                        {{ __('forgot-password.secure') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

@endsection