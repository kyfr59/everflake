@extends('layouts.app')

@section('title', 'Everflake — Votre titre SEO')

@section(
    'description',
    'Découvrez Everflake et nos services. Une description claire de votre activité en quelques mots.'
)

@section('content')

    <h1>{{ __('messages.welcome') }}</h1>

    <div class="lang-switcher">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
            class="{{ app()->getLocale() == $localeCode ? 'active' : '' }}"
            hreflang="{{ $localeCode }}" >
                {{ $properties['native'] }}</a>&nbsp;|
        @endforeach
    </div>
@endsection
