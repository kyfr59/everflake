@props(['class' => ''])

<svg
    {{ $attributes->merge(['class' => $class]) }}
    width="18" height="18" viewBox="0 0 18 18" fill="none"
>
    <path
        d="M2.5 2.5l13 13"
        stroke="currentColor"
        stroke-linecap="round"
        stroke-width="2"
    />
    <path
        d="M7.53 4.36A8.6 8.6 0 0 1 9 4.25c4.5 0 8 5 8 5a14.5 14.5 0 0 1-2.29 2.77M5.1 5.6A14.7 14.7 0 0 0 1 9.25s3.5 5 8 5c1.1 0 2.13-.3 3.06-.78"
        stroke="currentColor"
        stroke-linecap="round"
        stroke-width="2"
    />
    <path
        d="M7.4 7.4a2.5 2.5 0 0 0 3.2 3.2"
        stroke="currentColor"
        stroke-linecap="round"
        stroke-width="2"
    />
</svg>