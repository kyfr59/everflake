<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ in_array(app()->getLocale(), ['ar', 'he', 'fa']) ? 'rtl' : 'ltr' }}"
>
    <head>
        <meta charset="utf-8">

        <meta
            name="viewport"
            content="width=device-width, initial-scale=1"
        >

        {{-- SEO --}}
        <title>@yield('title', config('app.name'))</title>

        <meta
            name="description"
            content="@yield('description', 'Description de votre site')"
        >

        <meta name="robots" content="@yield('robots', 'index,follow')">

        {{-- Canonical --}}
        <link
            rel="canonical"
            href="{{ url()->current() }}"
        >

        {{-- Hreflang --}}
        @if (LaravelLocalization::getSupportedLocales())
            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <link
                    rel="alternate"
                    hreflang="{{ $localeCode }}"
                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                >
            @endforeach

            <link
                rel="alternate"
                hreflang="x-default"
                href="{{ LaravelLocalization::getLocalizedURL('fr', null, [], true) }}"
            >
        @endif

        {{-- Open Graph --}}
        <meta
            property="og:title"
            content="@yield('og_title', View::getSection('title'))"
        >

        <meta
            property="og:description"
            content="@yield('og_description', View::getSection('description'))"
        >

        <meta
            property="og:url"
            content="{{ url()->current() }}"
        >

        <meta property="og:type" content="website">

        <meta
            property="og:locale"
            content="{{ str_replace('-', '_', app()->getLocale()) }}"
        >

        {{-- Twitter / X --}}
        <meta name="twitter:card" content="summary_large_image">

        <meta
            name="twitter:title"
            content="@yield('twitter_title', View::getSection('title'))"
        >

        <meta
            name="twitter:description"
            content="@yield('twitter_description', View::getSection('description'))"
        >

        {{-- Assets --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

<body>
    @yield('content')
</body>
</html>