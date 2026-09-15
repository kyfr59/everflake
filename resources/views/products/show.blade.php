@extends('layouts.app')

@section('title', 'Everflake — Votre titre SEO')

@section(
    'description',
    'Découvrez Everflake et nos services. Une description claire de votre activité en quelques mots.'
)

@section('content')

    @include('partials.nav')

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

            @if($options->isNotEmpty())

        <h2>Options</h2>

        @if($options->isNotEmpty())
            <h2>Options</h2>
@foreach($options as $option)

    <label>
        <input
            type="radio"
            name="frame"
            value="{{ $option->id }}"
        >

        {{ $option->label }}

        @if($option->price_modifier > 0)
            (+{{ number_format($option->price_modifier / 100, 2, ',', ' ') }} €)
        @endif
    </label>

    <br>

@endforeach
        @endif

    @endif

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

@if($product->active && $product->stock > 0)

   <script>
    async function computePrice() {

        const selectedFrame = document.querySelector(
            'input[name="frame"]:checked'
        );

        const quantity = document.getElementById('quantity');

        const response = await fetch(
            "{{ route('products.price', $product) }}",
            {
                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                body: JSON.stringify({
                    option_id: selectedFrame
                        ? selectedFrame.value
                        : null,

                    quantity: quantity
                        ? quantity.value
                        : 1
                })
            }
        );

        if (!response.ok) {
            console.error('Erreur lors du calcul du prix');
            return;
        }

        const data = await response.json();


                document.getElementById('price').textContent =
    data.total_price + ' €';
    }

    // Quand une option est sélectionnée
    document
        .querySelectorAll('input[name="frame"]')
        .forEach(function (radio) {
            radio.addEventListener('change', computePrice);
        });

    // Quand la quantité change
    const quantity = document.getElementById('quantity');

    if (quantity) {
        quantity.addEventListener('input', computePrice);
    }
</script>

@endif

@endsection