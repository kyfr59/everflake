@extends('layouts.app')

@section('content')

<div class="container">

    <h1>{{ $product->name }}</h1>

    <p>
        {{ $product->description }}
    </p>

    <p>
        <strong>
            {{ number_format($product->price / 100, 2, ',', ' ') }} €
        </strong>
    </p>

    <p>
        Stock : {{ $product->stock }}
    </p>

    @if($product->active && $product->stock > 0)

        <form
            method="POST"
            action="{{ route('cart.add', $product) }}"
        >
            @csrf

            <select id="size">
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
            </select>

            <select id="color">
                <option value="black">Noir</option>
                <option value="white">Blanc</option>
            </select>

            <p>
                Prix :
                <strong id="price">19,90 €</strong>
            </p>

            <button id="add-to-cart">
                Ajouter au panier
            </button>

            <button type="submit">
                Ajouter au panier
            </button>
        </form>

    @else

        <p>Produit indisponible.</p>

    @endif

    <br>

    <a href="{{ route('products.index') }}">
        ← Retour aux produits
    </a>

</div>

@endsection