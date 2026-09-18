@extends('layouts.app')

@section('title', 'Everflake — Votre titre SEO')

@section(
    'description',
    'Découvrez Everflake et nos services. Une description claire de votre activité en quelques mots.'
)

@section('content')

    @include('partials.nav')

    @if(session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div>
            {{ session('error') }}
        </div>
    @endif

    <hr>

    @forelse($products as $product)

        <article>
            <h2 class="text-3xl">
                <a href="{{ route('products.show', $product) }}">
                    {{ $product->name }}
                </a>
            </h2>

            <p>
                {{ $product->description }}
            </p>

            <p class="text-red-700">
                {{ $product->formatted_price }}
            </p>


        </article>

        <hr>

    @empty

        <p>Aucun produit.</p>

    @endforelse

@endsection


