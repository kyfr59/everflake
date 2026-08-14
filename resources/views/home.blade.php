<div class="lang-switcher">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
           class="{{ app()->getLocale() == $localeCode ? 'active' : '' }}">
            {{ $properties['native'] }}</a>&nbsp;|
    @endforeach
</div>

<h1>{{ __('messages.welcome') }}</h1>