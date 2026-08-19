@extends('layouts.app')

@section('title', 'Everflake — Votre titre SEO')

@section(
    'description',
    'Découvrez Everflake et nos services. Une description claire de votre activité en quelques mots.'
)

@section('content')

    @include('partials.nav')

    <main class="min-h-[80vh] bg-white">
        <div class="px-5 sm:px-10 lg:px-8 py-20 text-center">
            <h1 class="text-3xl font-bold text-ef-link-black">
                {{ request()->route()->getName() }}
            </h1>
        </div>
    </main>

@endsection
