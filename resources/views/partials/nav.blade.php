<nav class="sticky top-0 z-50 bg-white border-b border-ef-border-grey" aria-label="{{ __('messages.main_navigation') }}">
    <div class="flex h-20 lg:h-26 items-center justify-between px-5 sm:px-10 lg:px-8">

        {{-- Logo --}}
        <div class="shrink-0 mt-2">
            <a href="{{ url(app()->getLocale()) }}" class="inline-block">
                <img
                    width="120"
                    height="90"
                    class="w-[100px] lg:w-[120px] h-auto transition-all duration-200 hover:opacity-80 mt-1"
                    src="{{ asset('images/logo.png') }}"
                    alt="{{ __('messages.baseline') }}"
                />
            </a>
        </div>

        {{-- Menu desktop --}}
        <div class="hidden lg:flex gap-8 items-center">
            <a href="#collection" class="font-medium text-sm text-ef-link-black hover:text-ef-link-red-hover transition-colors" data-target="collection">Collection</a>
            <a href="#customize" class="font-medium text-sm text-ef-link-black hover:text-ef-link-red-hover transition-colors" data-target="customize">Customize</a>
            <a href="{{ route('about') }}" class="font-medium text-sm text-ef-link-black hover:text-ef-link-red-hover transition-colors" data-target="{{ route('about') }}">{{ __('messages.about') }}</a>
            <a href="{{ route('contact') }}" class="font-medium text-sm text-ef-link-black hover:text-ef-link-red-hover transition-colors" data-target="{{ route('contact') }}">Contact</a>
        </div>

        {{-- Liens de droite --}}
        <div class="flex items-center gap-3">

            {{-- Barre de langue --}}
            <div class="hidden lg:flex items-center gap-3 pr-5 border-r border-ef-border-grey">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a
                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                    class="{{ app()->getLocale() == $localeCode ? 'active' : '' }} lang-btn font-mono font-bold text-[13px] uppercase cursor-pointer text-ef-link-grey hover:text-ef-link-black transition-colors duration-200"
                    aria-label="{{ ucfirst($properties['native']) }}"
                    lang="{{ $localeCode }}"
                    hreflang="{{ $localeCode }}">
                        {{ $localeCode }}
                    </a>
                @endforeach
            </div>

            {{-- Panier --}}
            <button id="cart-btn" aria-label="{{ __('messages.cart_empty') }}" class="flex mr-2 relative p-2 lg:-mt-2 {{-- !! --}} text-ef-link-black hover:text-ef-link-red-hover transition-colors cursor-pointer">
                <x-icons.cart />
                {{-- <span id="cart-badge" class="absolute -top-0.5 -right-0.5 bg-[#c8102e] text-white text-[10px] font-mono font-bold rounded-full min-w-[16px] h-4 flex items-center justify-center px-1">1</span>--}}
            </button>

            {{-- Connexion / déconnexion --}}
            @auth
                @include('partials.logout')
            @else
                <a href="{{ route('login') }}" class="hidden lg:inline-flex items-center justify-center bg-ef-link-red hover:bg-ef-link-red-hover text-white text-[14px] font-semibold uppercase px-6 py-3 rounded-sm transition-colors cursor-pointer whitespace-nowrap">
                    {{ __('messages.login') }}
                </a>
            @endauth

            {{-- Menu user --}}
            @auth
                <button id="user-burger-btn" class="lg:hidden p-2 cursor-pointer">
                    <x-icons.user id="burger-menu-close" />
                    <x-icons.menu-open id="burger-menu-open" class="hidden" />
                </button>
            @endauth

            {{-- Menu burger --}}
            <button aria-label="{{ __('messages.open-menu') }}" id="burger-btn" class="lg:hidden p-2 cursor-pointer">
                <x-icons.menu-close id="menu-close" />
                <x-icons.menu-open id="menu-open" class="hidden" />
            </button>
        </div>
    </div>

    {{-- Menu user mobile --}}
    @auth
        <div id="user-mobile-menu" class="hidden lg:hidden bg-white border-t border-ef-border-grey px-5 py-5 flex-col gap-5 max-h-0 opacity-0 overflow-hidden transition-all duration-300 ease-out">

            <div class="border-b border-ef-border-grey pb-4 flex items-center gap-2.5">
                <x-icons.user />
                <div class="flex flex-col leading-snug">
                    <span class="text-sm font-semibold text-ef-black">{{ Auth::user()->name }}</span>
                    <span class="text-sm text-[#9ca3af]">{{ Auth::user()->email }}</span>
                </div>
            </div>

            <a href="{{ route('about') }}" class="block font-medium text-sm text-ef-link-black hover:text-ef-link-red-hover transition-colors" data-target="{{ route('about') }}">{{ __('messages.account') }}</a>
            <a href="{{ route('about') }}" class="block font-medium text-sm text-ef-link-black hover:text-ef-link-red-hover transition-colors" data-target="{{ route('contact') }}">{{ __('messages.orders') }}</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button aria-label="{{ __('messages.logout') }}" type="submit" class="w-full bg-ef-link-red hover:bg-ef-link-red-hover text-white text-[14px] font-semibold uppercase px-6 py-3 rounded-sm transition-colors cursor-pointer text-center">
                    {{ __('messages.logout') }}
                </button>
            </form>
        </div>
    @endauth

    {{-- Menu mobile --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-ef-border-grey px-5 py-5 flex-col gap-5 max-h-0 opacity-0 overflow-hidden transition-all duration-300 ease-out">
        <a href="#collection" class="block font-medium text-sm text-ef-link-black hover:text-ef-link-red-hover transition-colors" data-target="collection">Collection</a>
        <a href="#customize" class="block font-medium text-sm text-ef-link-black hover:text-ef-link-red-hover transition-colors" data-target="customize">Customize</a>
        <a href="{{ route('about') }}" class="block font-medium text-sm text-ef-link-black hover:text-ef-link-red-hover transition-colors" data-target="{{ route('about') }}">{{ __('messages.about') }}</a>
        <a href="{{ route('contact') }}" class="block font-medium text-sm text-ef-link-black hover:text-ef-link-red-hover transition-colors" data-target="{{ route('contact') }}">Contact</a>

        <div class="flex items-center gap-4 pt-4 border-t border-ef-border-grey">
            <x-icons.globe class="w-4 h-4 text-gray-400 -mt-2" />
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <a
                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                class="{{ app()->getLocale() == $localeCode ? 'active' : '' }} lang-btn font-mono font-bold text-[13px] uppercase cursor-pointer text-grey"
                aria-label="{{ ucfirst($properties['native']) }}"
                lang="{{ $localeCode }}"
                hreflang="{{ $localeCode }}">
                    {{ $localeCode }}
                </a>
            @endforeach
        </div>

        @guest
            <a href="{{ route('login') }}" class="ef-button-red">
                {{ __('messages.login') }}
            </a>
        @endguest
    </div>
</nav>
