<h1>Mon panier</h1>

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

@if($cart && $cart->items->count())

    @foreach($cart->items as $item)

        <article>
            <h2>
                {{ $item->itemable->name }}
            </h2>

            <p>
                Prix :
                {{ number_format($item->price / 100, 2, ',', ' ') }} €
            </p>

            <p>
                Quantité : {{ $item->quantity }}
            </p>

            <form
                method="POST"
                action="{{ route('cart.remove', $item) }}"
            >
                @csrf
                @method('DELETE')

                <button type="submit">
                    Supprimer
                </button>
            </form>
        </article>

        <hr>

    @endforeach

@else

    <p>Votre panier est vide.</p>

@endif

<form method="POST" action="{{ route('cart.clear') }}">
    @csrf
    @method('DELETE')

    <button type="submit">
        Vider le panier
    </button>
</form>

<a href="{{ route('products.index') }}">
    Continuer mes achats
</a>