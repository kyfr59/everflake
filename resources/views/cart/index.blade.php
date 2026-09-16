@php use Illuminate\Support\Number; @endphp

@extends('layouts.app')

@section('title', 'Everflake — Votre titre SEO')

@section(
    'description',
    'Découvrez Everflake et nos services. Une description claire de votre activité en quelques mots.'
)

@section('content')

    @include('partials.nav')

    <h1 class="text-3xl">Mon panier</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div>{{ session('error') }}</div>
    @endif

    @if($cart && $cart->items->count())

        @php $total = 0; @endphp

        @foreach($cart->items as $item)

            @php
                $unitPrice = $item->getOption('unit_price');
                $convertedUnitPrice = (int) round($unitPrice * $item->exchange_rate);
                $lineTotal = $convertedUnitPrice * $item->quantity;
                $total += $lineTotal;

                $formattedUnit = Number::currency($convertedUnitPrice / 100, $item->currency);
                $formattedLine = Number::currency($lineTotal / 100, $item->currency);
            @endphp

            <article>
                <h2>{{ $item->itemable->name }}</h2>

                <p>Prix unitaire : {{ $formattedUnit }}</p>
                <p>Quantité : {{ $item->quantity }}</p>
                <p>Sous-total : {{ $formattedLine }}</p>

                <form method="POST" action="{{ route('cart.remove', $item) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </article>

            <hr>

        @endforeach

        <p>
            <strong>
                Total : {{ Number::currency($total / 100, $cart->items->first()->currency) }}
            </strong>
        </p>

    @else
        <p>Votre panier est vide.</p>
    @endif

    @if($cart && $cart->items->count())
        <form method="POST" action="{{ route('cart.clear') }}">
            @csrf
            @method('DELETE')
            <button type="submit">Vider le panier</button>
        </form>
    @endif

    <br /><a href="{{ route('products.index') }}">Continuer mes achats</a><br /><br />

@endsection