@extends('layouts.app')

@section('title', 'Everflake — Votre titre SEO')

@section(
    'description',
    'Découvrez Everflake et nos services. Une description claire de votre activité en quelques mots.'
)

@section('content')

    @include('partials.nav')

    <img src="/temp.png" class="w-full" />

@endsection
